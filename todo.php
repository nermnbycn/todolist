<?php
include "db_conn.php";
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>TodoList</title>
</head>
<body>
    <div class="background">
        <div class="card-body">
            <div class="center">
                <form id="todo-form" class="margin-todo-form" method="post" action="addtodo.php">
                    <div class="margin-input">
                        <input id="todo" name="todo" autocomplete="off" placeholder="Entry todo..." required>
                    </div>
                    <div class="center">
                        <div class="margin-input margin-right">
                            <select id="priority" name="priority" required>
                                <option value="" disabled selected>Priority Status</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="margin-input">
                            <select id="tags" name="tags" required>
                                <option value="" disabled selected>Tag</option>
                                <option value="Personal">Personal</option>
                                <option value="Work">Work</option>
                                <option value="Home">Home</option>
                                <option value="Shopping">Shopping</option>
                                <option value="Fitness">Fitness</option>
                                <option value="Hobyy">Hobyy</option>
                                <option value="Finance">Finance</option>
                                <option value="Education">Education</option>
                                <option value="Social">Social</option>
                            </select>
                        </div>
                    </div>
                    <div class="center">
                        <div class="btn">
                            <div class="inner"></div>
                            <button type="submit">Add Todo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
            $sql =  "SELECT * FROM todos WHERE user_id = $user_id ORDER BY todo_id DESC";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
        ?>
        <div class="card-body">
    <div id="todo-Area">
    <?php
    $sql2="SELECT * FROM todos WHERE user_id=$user_id";
    $result2=mysqli_query($conn,$sql2);
    $rowCount2 = mysqli_num_rows($result2); 
    if($rowCount2 > 0) {
        echo '<h5>TODOS</h5>';
    }
    ?>
        <?php if ($rowCount > 0) { ?>
            <div class="todo-container">
               
                <?php while ($row = mysqli_fetch_assoc($result)) {
                     $priorityClass = '';
                     if ($row['todo_priority'] === 'Low') {
                         $priorityClass = 'bgcolor-green';
                     } elseif ($row['todo_priority'] === 'Medium') {
                         $priorityClass = 'bgcolor-yellow'; 
                     } elseif ($row['todo_priority'] === 'High') {
                         $priorityClass = 'bgcolor-red'; 
                     }
                    
                    
                    ?>
                    <div class="todo-item <?php echo $priorityClass; ?>">
                        <div class="xmark" data-id="<?php echo $row['todo_id']; ?>" onclick="deleteTodo(<?php echo $row['todo_id']; ?>)"><i class="fa-solid fa-square-xmark"></i></div>
                        <div class="checkmark" data-id="<?php echo $row['todo_id']; ?>" onclick="completedTodo(<?php echo $row['todo_id']; ?>)"><i class="fa-solid fa-square-check"></i></div>
                        <div class=display>
                           <div><p class="font"><strong>Todo Name: </strong><?php echo ucfirst(htmlspecialchars($row['todo_name']));?></p></div>
                           <div><p class="font"><strong>Todo Priority: </strong><?php echo htmlspecialchars($row['todo_priority']); ?></p></div> 
                           <div><p class="font"><strong>Todo Tag: </strong><?php echo htmlspecialchars($row['todo_tag']); ?> </p></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
            
    </div>
</div>
        <div class="card-body">
            <div id="todos-made">
            <?php
     $sql3 = "SELECT * FROM completedtodo WHERE user_id = $user_id";
    $result3=mysqli_query($conn,$sql3);
    $rowCount3 = mysqli_num_rows($result3); 
    if($rowCount3 > 0) {
        echo '<div class="margin-top"><h5>COMPLETED TODOS</h5></div>';
    }
    ?>
                <div class="todo-container">
                <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
            <div class="todo-item completed">
                <div class="display">
                <p class="font"><strong>Todo Name: </strong><?php echo ucfirst(htmlspecialchars($row['completed_name'])); ?></p>
                <p class="font"><strong>Todo Priority: </strong><?php echo htmlspecialchars($row['completed_priority']); ?></p>
                <p class="font"><strong>Todo Tag: </strong><?php echo htmlspecialchars($row['completed_tag']); ?></p>
                </div>
            </div>
               <?php } ?>
                </div>
            </div>
        </div>
    </div>
<script src="todo.js"></script>
</body>
</html>
