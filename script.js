// Lista de bandas para pesquisa
const bands = [
    { name: "Nirvana", link: "nirvana.html" },
    { name: "Pearl Jam", link: "pearl_jam.html" },
    { name: "Black Sabbath", link: "black_sabbath.html" },
    { name: "Led Zeppelin", link: "led_zeppelin.html" },
    { name: "Radiohead", link: "radiohead.html" }
];

// Função de pesquisa
function searchBand(event) {
    event.preventDefault(); // Evita o envio do formulário e recarregamento da página

    const searchTerm = document.getElementById('searchInput').value.toLowerCase(); // Termo de pesquisa em minúsculo
    const results = bands.filter(band => band.name.toLowerCase().includes(searchTerm)); // Filtra as bandas com base no termo

    displayResults(results); // Exibe os resultados
}

// Função para exibir os resultados da pesquisa
function displayResults(results) {
    const resultSection = document.getElementById('searchResults'); // A seção onde os resultados serão exibidos
    resultSection.innerHTML = ''; // Limpa resultados anteriores

    if (results.length === 0) {
        resultSection.innerHTML = '<p>Nenhuma banda encontrada.</p>'; // Mensagem caso não haja resultados
    } else {
        results.forEach(band => {
            const resultItem = document.createElement('p'); // Cria um novo item para cada resultado
            resultItem.innerHTML = `<a href="${band.link}">${band.name}</a>`; // Cria o link para a banda
            resultSection.appendChild(resultItem); // Adiciona o item à seção de resultados
        });
    }
}