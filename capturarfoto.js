var video = document.querySelector('video');

navigator.mediaDevices.getUserMedia({video:true})
.then(stream => {
    video.srcObject = stream;
    video.play();
})
.catch(error => {
    console.log(error);
})

document.querySelector('#capturar').addEventListener('click', () => {
    var canvas = document.querySelector('canvas');
    canvas.height = video.videoHeight;
    canvas.width = video.videoWidth;
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    var imageDataUrl = canvas.toDataURL('image/png');
    document.getElementById('imagem-base64').value = imageDataUrl;
    
    var img = document.getElementById('imagem-capturada');
    img.src = imageDataUrl;
    img.style.display = 'block';

    
});