## Instalação

mkdir app/code/community/Cammino
git submodule add git@github.com:mferracioli/magento-banners.git app/code/community/Cammino/Banners
cp app/code/community/Cammino/Banners/Cammino_Banners.csv app/locale/pt_BR/
cp app/code/community/Cammino/Banners/Cammino_Banners.xml app/etc/modules/
cp app/code/community/Cammino/Banners/cammino_banners.css skin/adminhtml/default/default/
cp app/code/community/Cammino/Banners/banners.xml app/design/adminhtml/default/default/layout/

## Configurações
- As configurações das áreas ficam em: Sistema > Geral > Gerenciador de Conteúdo > Banner Settings
- As áreas dos banners devem ser separadas por vírgula e sem espaço, ex: home,produto

## Como usar
```php
<?php $modelBanners = Mage::getModel('banners/banners'); ?>
<?php $slides = $modelBanners->getSlides('home-principal'); // home-principal é o nome da área  ?>
<?php foreach ($slides as $slide): ?>
	<a href="<?php echo $slide['url']; ?>">
		<img src="<?php echo $modelBanners->getFilePath() . $slide['filename']; ?>" alt="<?php echo $slide['title']; ?>">
    </a>
<?php endforeach; ?>
```