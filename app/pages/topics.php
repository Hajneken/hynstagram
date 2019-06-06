<?php
require './db/connectDb.php';

function fetchAllTopics(PDO $db)
{
    $query = $db->prepare('SELECT * FROM Topics order by date;');
    $query->execute();
    $topicsArray = $query->fetchAll();
    return $topicsArray;
}

$topicsArray = fetchAllTopics($db);

?>

<section class="section-container mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wrapper">
                    <h2 class="header">List of all topics</h2>
                    <ol class="list-group">
                        <?php
                        // var_dump($topicsArray);
                        // echo (count($topicsArray));
                        for ($i = 0; $i < count($topicsArray); $i++) {
                            $topicID = $topicsArray[$i]['topicID'];
                            $topicName = $topicsArray[$i]['name'];

                            echo '<li class="list-group-item"><a href="./topic.php?id=' . $topicID . '" class="list-group__link">' . $topicName . '</a></li>';
                        }
                        
                        ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>