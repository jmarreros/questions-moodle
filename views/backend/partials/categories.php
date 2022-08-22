<?php
/** @var array $categories */
?>
<br>
<form action="" id="frm-categories">
    <table id="table-categories">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Children</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $category): ?>
            <tr>
                <td><?= $category['id'] ?></td>
                <td><?= $category['name'] ?></td>
                <td><?php 
                    if ( $category['children'] ){
                        echo "<ul>";
                        foreach ($category['children'] as $child) {
                            $url = admin_url( DCMS_QUESTIONS_SUBMENU . "?page=questions-moodle&tab=questions&id=" . $child['id']);
                            echo "<li class='child-category'>";
                            echo "<strong> {$child['id']} </strong> - " ;
                            echo "<a href=' {$url} '> {$child['name']} </a>";
                            echo "({$child['qty']})";
                            echo "</li>";
                        }
                        echo "</ul>";
                    }
                ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

