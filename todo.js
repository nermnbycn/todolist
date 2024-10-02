function deleteTodo(todo_id) {
    if (confirm("Bu todo'yu silmek istediğinize emin misiniz?")) {
        window.location.href = 'deletetodo.php?id=' + todo_id; // delete.php'ye yönlendirme
    }
}

function completedTodo(todo_id){
        window.location.href='completedtodos.php?id=' + todo_id;
}







