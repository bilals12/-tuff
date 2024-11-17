const audio = document.querySelector('#audio');
const audioButton = document.querySelector('#audioButton');

const audioUrls = [
"suslol.mp3"
];

const randomAudio = () => {
  const index = Math.floor(Math.random() * audioUrls.length);
  const audioUrl = audioUrls[index];
  
  return audioUrl;
}

audioButton.addEventListener("click", () => {
  audio.addEventListener("ended", () => {
    const audioUrl = randomAudio();
    
    const temp = new Audio();
    
    temp.addEventListener("loadeddata", () => {
      audio.src = audioUrl;
  });
    
    temp.src = audioUrl;
  })
  
  const audioUrl = randomAudio();
  
  audio.addEventListener("loadeddata", () => {
      audio.play();
  });
  
  audio.src = audioUrl;
  
})