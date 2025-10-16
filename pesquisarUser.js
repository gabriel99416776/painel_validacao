// Espera até que o documento esteja completamente carregado
document.addEventListener("DOMContentLoaded", function() {
    // Captura o elemento de entrada de pesquisa
    var inputPesquisarClientes = document.querySelector('.inputPesquisarClientes');
    
    // Adiciona um ouvinte de evento de entrada ao elemento de pesquisa
    inputPesquisarClientes.addEventListener('input', function() {
        // Obtém o valor digitado no campo de pesquisa
        var termoPesquisa = inputPesquisarClientes.value.toLowerCase();
        
        // Obtém todos os itens do accordion
        var accordionItens = document.querySelectorAll('.accordion-item');
        
        // Remove a mensagem de "Nenhum usuário encontrado!" se ela existir
        var mensagemNenhumResultado = document.querySelector('.alert-info');
        if (mensagemNenhumResultado) {
            mensagemNenhumResultado.remove();
        }
        
        // Define uma variável para verificar se algum item foi exibido
        var algumItemExibido = false;
        
        // Itera sobre cada item do accordion
        accordionItens.forEach(function(item) {
            // Obtém o texto do item do accordion
            var textoItem = item.textContent.toLowerCase();
            
            // Verifica se o texto do item contém o termo de pesquisa
            if (textoItem.includes(termoPesquisa)) {
                // Se contiver, exibe o item do accordion
                item.style.display = 'block';
                algumItemExibido = true;
            } else {
                // Caso contrário, oculta o item do accordion
                item.style.display = 'none';
            }
        });
        
        // Verifica se algum item foi exibido
        if (!algumItemExibido) {
            // Se nenhum item foi exibido, adiciona dinamicamente a mensagem
            var mensagemNenhumResultado = document.createElement('div');
            mensagemNenhumResultado.textContent = 'Nenhum usuário encontrado!';
            mensagemNenhumResultado.classList.add('alert', 'alert-info', 'mt-3');
            document.querySelector('.accordion').appendChild(mensagemNenhumResultado);
        }
    });
});
