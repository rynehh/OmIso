function toggleContent(id) {
    const content = document.getElementById(id);
    if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
}

function eliminarComentario(commentId) {
    const commentElement = document.getElementById(commentId);
    commentElement.innerHTML = '<p><em>Este comentario fue eliminado</em></p>';
}
