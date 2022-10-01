<h2 class="h3 text-dark mt-4 mb-4">読書ログの登録</h2>
<form action="create.php" method="POST">
    <?php if (count($errors)) : ?>
        <ul class="text-danger">
            <?php foreach ($errors as $error) : ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="form-group">
        <!-- 書籍名 -->
        <label for="title">書籍名：</label>
        <input type="text" name="title" class="form-control" id="title" value="<?php echo $review['title'] ?>">
    </div>
    <div class="form-group">
        <!-- 著者名 -->
        <label for="author">著者名：</label>
        <input type="text" name="author" class="form-control" id="author" value="<?php echo $review['author'] ?>">
    </div>
    <div class="form-group">
        <label>読書状況</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" class="form-control" id="status1" value="未読" <?php echo ($review['status'] === "未読") ? 'checked' : ''; ?>>
                <label class="form-check-label" for="status1">未読</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" class="form-control" id="status2" value="読書中" <?php echo ($review['status'] === "読書中") ? 'checked' : ''; ?>>
                <label class="form-check-label" for="status2">読書中</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="status" id="status3" value="読了" <?php echo ($review['status'] === "読了") ? 'checked' : ''; ?>>
                <label class="form-check-label" for="status3">読了</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <!-- 評価 -->
        <label for="score">評価：</label>
        <input type="number" name="score" class="form-control" id="score" value="<?php echo $review['score'] ?>">
    </div>
    <div class="form-group">
        <!-- 感想 -->
        <label for="summary">感想：</label>
        <textarea name="summary" class="form-control" id="summary" rows="10"><?php echo $review['summary'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">登録する</button>
</form>
