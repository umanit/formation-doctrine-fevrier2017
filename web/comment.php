<?php

require '../bootstrap.php';

use Imie\Entity\Comment;

$postId = $_GET['pid'];
// $post = $entityManager->getRepository('Imie\Entity\Post')->find($postId);
$post = $entityManager->getRepository('Imie\Entity\Post')->findOneBy(array('id' => $postId));

if (isset($_POST['comment'])) {
    $comment = new Comment();
    $comment->setMessage($_POST['message']);
    $comment->setDate(new DateTime());
    $comment->setAuthor($currentUser);
    $comment->setPost($post);

    $entityManager->persist($comment);
    $entityManager->flush();
}

if (isset($_GET['removeId'])) {
    $comment = $entityManager->getRepository('Imie\Entity\Comment')->find($_GET['removeId']);

    $entityManager->remove($comment);
    $entityManager->flush();
}

$comments = $entityManager->getRepository('Imie\Entity\Comment')->findBy(
    array('post' => $post),
    array('date' => 'ASC')
);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>IMIEBook - Comment</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                <!-- main right col -->
                <div class="column col-sm-12 col-xs-12" id="main">

                    <!-- top nav -->
                    <div class="navbar navbar-blue navbar-static-top">
                        <div class="navbar-header">
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="/" class="navbar-brand logo">b</a>
                        </div>
                        <nav class="collapse navbar-collapse" role="navigation">
                            <form class="navbar-form navbar-left" action="post.php">
                                <div class="input-group input-group-sm" style="max-width:360px;">
                                    <input type="text" class="form-control" placeholder="Search" name="search-word" id="srch-term">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" name="search" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="full col-sm-9">

                            <!-- content -->
                            <div class="row">

                                <div class="col-sm-push-2 col-sm-8">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a href="#" class="pull-right">Link</a>
                                            <h4><?php print $post->getSubject(); ?></h4>
                                            <?php print $post->getDate()->format('d/m/Y H:i'); ?>
                                        </div>
                                        <div class="panel-body">
                                            <?php print $post->getMessage(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php foreach ($comments as $comment): ?>
                                    <div class="col-sm-push-2 col-sm-8">
                                        <div class="panel panel-default">
                                            <a href="comment.php?pid=<?php print $post->getId(); ?>&removeId=<?php print $comment->getId(); ?>">Remove</a>
                                            <div class="panel-body">
                                                <?php print $comment->getDate()->format('d/m/Y H:i'); ?><br/>
                                                <?php print $comment->getMessage(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="col-sm-push-2 col-sm-8">
                                    <div class="well">
                                        <form class="form-horizontal" role="form" method="POST" action="comment.php?pid=<?php print $post->getId(); ?>">
                                            <h4>Commenter</h4>
                                            <div class="form-group" style="padding:14px;">
                                                <textarea class="form-control" name="message" placeholder="Message"></textarea>
                                            </div>
                                            <button class="btn btn-primary pull-right" name="comment" type="submit">Envoyer</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
                                        </form>
                                    </div>
                                </div>
                            </div><!--/row-->
                            <hr>
                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->

            </div>
        </div>
    </div>
    <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
