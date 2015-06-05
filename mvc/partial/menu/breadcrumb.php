<?php
	$controller = $this->getDispatcher()->getMvcRequest('controller');
	$action     = $this->getDispatcher()->getMvcRequest('action');
	$baseUrl    = $this->route(false, false, array());
?>
<div class="breadcrumb-wrapper type6">
    <div class="container">
      <div class="main-title">
        <h1>Header 7</h1>
        <div class="breadcrumb"> <a href="index.html">Home</a> <span class="default"> / </span> <a href="tabs-accordions.html">Pages</a> <span class="default"> / </span> <span class="current">Header 7</span> </div>
      </div>
    </div>
</div>