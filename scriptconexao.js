function updateIpStatus() {
    fetch('verificarleitor.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(ipStatus => {
                const statusContainer = document.getElementById(`status-${ipStatus.ip}`);
                if (!statusContainer) return;

                statusContainer.innerHTML = ''; 
                const circle = document.createElement('div');
                circle.classList.add('circle', ipStatus.status);
                circle.setAttribute('title', ipStatus.ip);
                const pingText = document.createElement('div');
                pingText.textContent = ipStatus.ping;
                pingText.style.fontSize = '12px';
                pingText.style.textAlign = 'center';
                pingText.style.marginTop = '4px';            
                statusContainer.appendChild(circle);
                statusContainer.appendChild(pingText);
            });
        })
        .catch(error => {
            console.error('Erro:', error);
        });
}

updateIpStatus();
setInterval(updateIpStatus, 1000);
