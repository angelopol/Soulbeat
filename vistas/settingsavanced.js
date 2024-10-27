
function toggleCard(arrow) {
    const card = arrow.closest('.card');
    const content = card.querySelector('.content-tarjet');
    
    if (content.style.maxHeight === "0px" || !content.style.maxHeight) {
        content.style.maxHeight = "32vh"; // Ajusta este valor según el contenido
        arrow.classList.add('down');
    } else {
        content.style.maxHeight = "0px";
        arrow.classList.remove('down');
    }
};