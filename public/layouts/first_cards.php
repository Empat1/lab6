<?php

$cards = $params['cards'];

if (count($cards) > 0):
    foreach ($cards as $screenshot): ?>

        <div class="card" data-id=<?= $screenshot['id'] ?>>
            <img class="card__photo" src=<?= $screenshot['url'] ?> alt="Нет фото"/>
            <div class="card__info">
                <a class="card__link" href= <?= "/details/?uuid=" . $screenshot['uuid'] ?>><span
                            class="card__name"> <?= $screenshot['name'] ?></span></a>
                <span class="card__data-added"><?= $screenshot['date_added'] ?></span>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (count($cards) == 10): ?>
    <button class="btn more_cards" onclick="load_more()">Показать еще</button>
<?php endif; ?>
<?php endif; ?>
