document.getElementById('addQuestionForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('add_question.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            this.reset();
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
// JavaScript source code
