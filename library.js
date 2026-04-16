// ==========================================
// 📚 PÁGINA: BIBLIOTECA (BUSCA REAL)
// ==========================================
const formBiblioteca = document.querySelector('.library-form');
if (formBiblioteca) {
  formBiblioteca.addEventListener('submit', (event) => {
    event.preventDefault(); 

    // Pega o que o usuário digitou
    const termoBusca = document.getElementById('busca-material')?.value.toLowerCase() || "";
    const cards = document.querySelectorAll('.material-card');
    let encontrouAlgo = false;

    // Passa por cada material na tela escondendo ou mostrando
    cards.forEach(card => {
        const titulo = card.querySelector('.material-title').innerText.toLowerCase();
        const desc = card.querySelector('.material-desc').innerText.toLowerCase();
        
        if (titulo.includes(termoBusca) || desc.includes(termoBusca)) {
            card.style.display = 'flex'; // Mostra
            encontrouAlgo = true;
        } else {
            card.style.display = 'none'; // Esconde
        }
    });

    if (!encontrouAlgo) {
        alert("Nenhum material encontrado com esses termos.");
    }
  });
}