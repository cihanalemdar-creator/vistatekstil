<?php $languageCodes = ['tr', 'en', 'de', 'es']; ?>
<div class="language-switcher<?= !empty($mobile) ? ' language-switcher--mobile' : '' ?>" aria-label="<?= e($home['ui']['language']) ?>">
    <?php foreach ($languageCodes as $languageCode): ?>
        <a class="<?= $languageCode === $locale ? 'is-current' : '' ?>" href="<?= e(route_for($routeConfig, $pageKey, $languageCode)) ?>" lang="<?= e($locales[$languageCode]['htmlLang']) ?>"<?= $languageCode === $locale ? ' aria-current="true"' : '' ?>><?= e(!empty($mobile) ? $locales[$languageCode]['label'] : $locales[$languageCode]['shortLabel']) ?></a>
    <?php endforeach; ?>
</div>
