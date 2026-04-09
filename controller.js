/// 1. O Ponto de Entrada: Aguarda o navegador carregar o HTML
document.addEventListener('DOMContentLoaded', () => {
    console.log("🚀 Study2Gether: Controller inicializado.");

    // 2. Referência ao Formulário 
    const formulario = document.querySelector('#form-perfil');

    // 3. O Ouvinte de Eventos (Event Listener)
    if (formulario) {
        formulario.addEventListener('submit', async (event) => {
            // Evita que a página recarregue
            event.preventDefault();

            // 4. Captura os dados dinamicamente dos inputs da V2.0
            const dadosUsuario = {
                nome: document.querySelector('#nome') ? document.querySelector('#nome').value : "",
                status: document.querySelector('#status') ? document.querySelector('#status').value : "",
                instituicao: document.querySelector('#instituicao') ? document.querySelector('#instituicao').value : "",
                curso: document.querySelector('#curso') ? document.querySelector('#curso').value : "",
                semestre: document.querySelector('#semestre') ? document.querySelector('#semestre').value : "",
                interesses: document.querySelector('#interesses') ? document.querySelector('#interesses').value : "",
                nivelXP: 0, // Começa no nível inicial para gamificação
                dataCriacao: new Date().toLocaleDateString('pt-BR')
            };

            try {
                // 5. Chama o banco de dados (que está global no db.js)
                const idGerado = await db.adicionar(dadosUsuario);
                
                console.log(" Dados salvos com sucesso! ID:", idGerado);
                alert(`Perfil de ${dadosUsuario.nome} salvo com sucesso!`);

                // Limpa os campos após o sucesso se quiser (opcional)
                // formulario.reset();

            } catch (erro) {
                console.error(" Erro ao salvar no banco:", erro);
                alert("Erro técnico ao salvar dados. Verifique o console.");
            }
        });
    }

    // Função para buscar dados e mostrar no console/tela
    async function atualizarInterface() {
        // Garantir que o db já está inicializado antes de buscar
        try {
            const todosUsuarios = await db.buscarTodos();
            console.log("Lista atualizada de usuários no banco:");
            console.table(todosUsuarios);
        } catch (erro) {
            console.log("Banco de dados ainda vazio ou erro na leitura.");
        }
    }

    // Chama uma vez ao carregar a página para ver o que já está salvo
    atualizarInterface();
});
