function updateIpStatus() {
    fetch('verificarleitor.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(ipStatus => {

                // STATUS (bolinha)
                const statusContainer = document.getElementById(`status-${ipStatus.ip}`);
                if (!statusContainer) return;

                statusContainer.innerHTML = '';

                const circle = document.createElement('div');
                circle.className = `circle ${ipStatus.status}`;

                const pingText = document.createElement('span');
                pingText.textContent = ipStatus.ping;
                pingText.style.fontSize = '12px';

                statusContainer.appendChild(circle);
                statusContainer.appendChild(pingText);

                // 🔥 STATUS DA LINHA
                const row = document.querySelector(`tr[data-ip="${ipStatus.ip}"]`);
                if (!row) return;

                row.classList.remove('leitor-online', 'leitor-offline');

                if (ipStatus.status === 'online') {
                    row.classList.add('leitor-online');
                } else {
                    row.classList.add('leitor-offline');
                }
            });
        })
        .catch(error => console.error('Erro:', error));
}

updateIpStatus();
setInterval(updateIpStatus, 1000);
