<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/style_login.css">
</head>

<body>
    <?php require_once __DIR__ .'../../../../global/layout/header.php' ?>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <a href="index.php?controller=Article&action=create" class="btn btn-success">Thêm mới</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <!-- <th scope="col">Ảnh</th> -->
                            <th scope="col">Tên bài hát</th>
                            <th scope="col">Tóm tắt</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Thể loại</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $key => $article) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $article->getTitle() ?></td>
                                <!-- <td><img src="../../../<?= $article->getImgUrl() ?>" alt="<?= $article->getTitle() ?>" style="width: 100px; height: 100px;"></td> -->
                                <td><?php echo $article->getNameSong() ?></td>
                                <td><?= $article->getCategoryName() ?></td>
                                <td><?= $article->getSummary() ?></td>
                                <td><?= $article->getAuthorName() ?></td>
                                <td><a href="index.php?controller=Article&action=edit&id=<?= $article->getId() ?>" class="btn btn-primary">Sửa</a></td>
                                <td><a href="index.php?controller=Article&action=delete&id=<?= $article->getId() ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a></td>
                            </tr>
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>