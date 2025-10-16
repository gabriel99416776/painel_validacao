document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photo = document.getElementById('photo');
    const capture = document.getElementById('capture');
    const savePhoto = document.getElementById('savePhoto');
    const context = canvas.getContext('2d');

    // Acessar a câmera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Erro ao acessar a câmera: ", err);
        });

    // Capturar a imagem
    capture.addEventListener('click', function() {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataURL = canvas.toDataURL('image/jpeg');
        photo.src = dataURL;
        photo.style.display = 'block';
    });

    // Enviar a imagem para o servidor
    savePhoto.addEventListener('click', function() {
        const dataURL = canvas.toDataURL('image/jpeg');
        const formData = new FormData();
        formData.append('photo', dataURL);
        formData.append('userId', 'ID_DO_USUARIO'); // Substitua pelo ID do usuário

        fetch('uploadPhoto.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log('Sucesso:', result);
            alert('Foto atualizada com sucesso!');
            window.location.reload(); // Opcional: recarregar a página para atualizar a lista
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
});
