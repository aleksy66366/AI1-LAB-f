<section>
    <h2>Komentarze</h2>

    <?php foreach ($comments as $comment): ?>
        <article>
            <p><?= htmlspecialchars($comment->author); ?></p>
            <p><?= htmlspecialchars($comment->content); ?></p>
            <!-- Tu możesz dodać linki do edycji/usuwania -->
        </article>
    <?php endforeach; ?>
</section>
