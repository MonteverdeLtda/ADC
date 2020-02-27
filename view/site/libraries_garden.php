<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/
/*$request = $this->getRequest();
if (!isset($request['subject']) || $request['subject'] === "") {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=" . linkRoute('site', 'index') . "\">";
	exit();
}
$table = $request['subject'];*/
?>
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
.circle-color {
	position: relative;
	margin: 0 auto;
	width: 25px;
	height: 25px;
	border-radius: 9999px;
	background-color: HSL(45,100%,50%);
}

.jumbotron {
    /* background-image: url('https://2.bp.blogspot.com/-nJ12IC51iYA/Wm-DNYNd0mI/AAAAAAAA2xs/OXbDcqJk6EYXm6YTWi3t_g0j6FHUZNPfwCLcBGAs/s640/C%25C3%25B3mo%2Barmamos%2Bel%2Bfondo%2Bbibliogr%25C3%25A1fico%2Bde%2Buna%2Bbiblioteca.jpg'); */
	background-image: url('/public/assets/images/gettoknownativeplants.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 160px;
}

.post {
    background-color: #FFF;
    overflow: hidden;
    box-shadow: 0 0 1px #CCC;
}

.post img {
	/*
    filter: blur(2px);
    -webkit-filter: blur(2px);
    -moz-filter: blur(2px);
    -o-filter: blur(2px);
    -ms-filter: blur(2px);
	*/
	max-height: 150px;
}

.post .content {
    padding: 15px;
}

.post .author {
    font-size: 11px;
    color: #737373;
    padding: 25px 30px 20px;
}

.post .post-img-content {
    height: 124px;
    position: relative;
}

.post .post-img-content img {
    position: absolute;
}

.post .post-title {
    display: table-cell;
    vertical-align: bottom;
    z-index: 2;
    position: relative;
}

.post .post-title b {
    background-color: rgba(51, 51, 51, 0.58);
    display: inline-block;
    margin-bottom: 5px;
    color: #FFF;
    padding: 10px 15px;
    margin-top: 5px;
}

.garden-card {
	max-height: 265px;
	overflow: overlay;
	height: 265px;
	box-shadow: 0px 0px 1px #666;
	margin-bottom: 10px;
}

.garden-card .post-img-content img {
	/* height: 196px; */
    height: auto;
    width: 100%;
    max-height: 150px;
}

.stepContainer {
	position: relative;
	height: auto;
	min-height: 420px;
	height: auto !important;
}

#pic{
	display: none;
}
.newbtn{
	cursor: pointer;
}
#blah{
	max-width:100px;
	height:100px;
	margin-top:20px;
}
.carousel-inner {
    min-height: calc(25vh);
    height: 100%;
}
.carousel-inner img {
  height: auto;
  width: 100%;
}
</style>

<div id="garden-app">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="page-title">
			<div class="title_left">
				<h3><?= isset($title) ? $title : ""; ?> <small> </small></h3>
			</div>
		</div>
		<div class="container">
			<router-view :key="$route.fullPath" ></router-view>
		</div>
	</div>
	<div class="clearfix"></div>
</div>

<template id="home">
	<div>
		<hr>
		<div class="jumbotron">
			<div class="container">
				<h2 style="color: white;font-size: 3.5em;text-shadow: 0px 0px 5px #000;text-align: right;">Garden Monteverde</h2>
			</div><!-- /container -->
		</div><!-- /jumbotron -->
		<!-- //
		<div class="row">
			<div class="col-xs-12 col-sm-12">
				<form action="/hms/accommodations" method="GET"> 
					<div class="row">
						<div class="col-xs-12 col-md-12">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="¿Que estas buscando?" id="txtSearch"/>
								<div class="input-group-btn">
									<button class="btn btn-primary" type="submit">
									<span class="glyphicon glyphicon-search"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		-->
		
		<div class="row">
			<div class="col-xs-3" style="zoom: 0.8;">
				<h1 class="col-xs-12">Filtros</h1>
				<template v-if="options.filters.length > 0">
					<div class="col-xs-12" v-for="(filter, i_filter) in options.filters">
						<h2 class="col-xs-12" :title="filter.description">{{ filter.name }} ({{ filter.garden_filters_attributes.length }})</h2>
						
						<div class="col-xs-12">
							<div class="list-group">
								<template v-if="filter.garden_filters_attributes.length > 0">
									<template v-for="(option, i_option) in filter.garden_filters_attributes">
										<!-- // <a v-for="(option, i_option) in filter.garden_filters_attributes" class="list-group-item">-->
										<template v-if="filter.type == 'color'">
											<div class="list-group-item list-inline prod_color">
												<div class="row">
													<div class="col-xs-3">
														<input @change="load" v-model="temp_filters" :value="option.id" class="form-control" type="checkbox" />
													</div>
													<div class="col-xs-2">
														<div :title="option.text" :style="'background-color: ' + option.more" class="color"></div>
													</div>
													<div class="col-xs-7">
														{{ option.text }}
													</div>
												</div>
											</div>
										</template>
										<template v-else>
											<a class="list-group-item">
												<div class="row">
													<div class="col-xs-3">
														<input @change="load" v-model="temp_filters" :value="option.id" class="form-control" type="checkbox" />
													</div>
													<div class="col-xs-9">
														{{ option.text }}
													</div>
												</div>
											</a>
										</template>
									</template>
								</template>
								<template v-else>
									Sin opciones.
								</template>
								<!-- // <span href="#" class="list-group-item active">Apples</span> -->
							</div>
						</div>
					</div>
				</template>
				<template v-else>
					<div class="col-xs-12">
						<h2 class="col-xs-12">No hay filtros</h2>
					</div>
				</template>
			</div>
			
			<div class="col-xs-9">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="x_panel">
							<div class="x_title">
								Página: {{ page }}
								<ul class="nav navbar-right panel_toolbox">
									<?= 
										(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden_create') == true)) ? 
											"<li><router-link :to=\"{ name: 'Create' }\"><i class=\"fa fa-plus\"></i></router-link></li>"
										: "";
									?>
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						<ul class="pagination pagination-split pull-right">
							<li v-if="page > 1 && total > 0"><a @click="load();page--;"> &#60; </a></li>
							<li v-if="total > (limit * page)"><a @click="load();page++;"> &#62; </a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
					
					<div class="col-xs-12 col-sm-12">
						<div class="x_panel">
							<div class="x_content">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<template v-if="records.length > 0">
										<div v-for="(garden, index) in records" class="col-xs-6 col-sm-4 col-md-3 col-lg-3 garden-card">
											<div class="post">
												<div class="post-img-content">
													<img :src="'data:image/png;base64, ' + garden.picture.data" class="img-responsive" />
													<!-- // <img src="//placehold.it/920x500" class="img-responsive" /> -->
													<span class="post-title"><b>{{ garden.name_comercial }}</b><br />
														<b>{{ garden.name_botanico }}</b>
													</span>
												</div>
												<div class="content">
													<div class="author">
														<b>{{ garden.name_comun }}</b>
														<!-- // | <time datetime="2014-01-20">January 20th, 2014</time> garden_comun_names -->
													</div>
													<div>
														<!-- // {{ garden.description }} -->
														<!-- // {{ garden.garden_items }} -->
														
													</div>
													<div>
														<router-link class="btn btn-info btn-sm pull-right" :to="{ name: 'Single-Details', params: { garden_id: garden.id }}">
															Leer más
														</router-link>
													</div>
												</div>
												<div class="post-footer">
													<div class="row">
														<div class="col-xs-12">
															<!-- // <div class="circle-color" :style="'background-color:' + color.hex + '; border: 1px solid rgba(0,0,0,0.25)'"></div>  -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</template>
									<template v-else>
										<div class="col-xs-12 garden-card">
											<div class="post text-center text-bold">
												<template v-if="loading === false">
													<div class="post-img-content">
													</div>
													<div class="content">
														<div class="author">
															No hay informacion para mostrar
														</div>
													</div>
												</template>
												<template v-else>
													<div class="post-img-content">
														<span class="post-title"><b>Cargando...</b><br />
															<b>Espere...</b>
														</span>
													</div>
													<div class="content">
														<div class="author">
															<b><i class="fa fa-spinner fa-pulse"></i> </b>
															Buscando informacion
														</div>
													</div>
												</template>
											</div>
										</div>
									</template>
								</div>

							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						<ul class="pagination pagination-split pull-right">
							<li v-if="page > 1 && total > 0"><a @click="load();page--;"> &#60; </a></li>
							<li v-if="total > (limit * page)"><a @click="load();page++;"> &#62; </a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-xs-12 col-sm-12">
				<div class="x_panel">
					<div class="x_title">
						<ul class="nav navbar-right panel_toolbox">
							<li>
								Viendo: {{ (((page * limit) - limit) + 1) }}
								- 
								{{ (page * limit) }} / Total: {{ total }}
								 | 
								Limite x Página: {{ limit }}
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</template>

<template id="single-details">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>{{ record.name_botanico }}</h2>
						<ul class="nav navbar-right panel_toolbox">
							<?= (($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden_delete') == true)) ? 
								"<li><a accesskey=\"d\" @click=\"deleteThis()\"><i class=\"fa fa-trash\"></i></a></li>"
								: "";
							?>
							<?= 
								(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden_edit') == true)) ? 
									"<li><router-link accesskey=\"e\" class=\"close-link\" :to=\"{ name: 'Edit-Details', params: { garden_id: record.id } }\"><i class=\"fa fa-edit\"></i></router-link></li>"
								: "";
							?>
							<?= 
								(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden') == true)) ? 
									"<li><router-link accesskey=\"c\" class=\"close-link\" :to=\"{ name: 'Home' }\"><i class=\"fa fa-close\"></i></router-link></li>"
								: "";
							?>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="col-md-7 col-sm-7 col-xs-12">
							<div class="product-image">
								<div id="myCarousel" class="carousel slide" data-ride="carousel">
								  <ol class="carousel-indicators">
									<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
									<template v-if="record.garden_gallery.length > 0">
										<li v-for="(img,img_index) in record.garden_gallery" data-target="#myCarousel" :data-slide-to="img_index++"></li>
									</template>
								  </ol>

								  <!-- Wrapper for slides -->
									<div class="carousel-inner">
										<div class="item active">
											<img :src="'data:image/png;base64, ' + record.picture.data" />
											<!-- //
											<div class="carousel-caption">
												<h3>Los Angeles</h3>
												<p>LA is always so much fun!</p>
											</div>
											-->
										</div>
										
										<template v-if="record.garden_gallery.length > 0">
											<div class="item" v-for="(img,img_index) in record.garden_gallery">
												<img height="100%" :src="'data:image/png;base64, ' + img.picture.data" />
											</div>
										</template>
									</div>
									
									<!-- Left and right controls -->
									<a class="left carousel-control" href="#myCarousel" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
							</div>
						</div>
						
						<div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
							<h3 class="prod_title">{{ record.name_comercial }}</h3>
							<p>{{ record.description }}</p>
							
							<h3 class="prod_title">Cuidados</h3>
							<p>{{ record.attendance }}</p>
							
							<template>
								<br />
								<div class="">
									<h2>Más nombres comúnes <small></small></h2>
									<ul class="list-inline prod_size">
										<li v-if="record.name_comun.length > 2">
											<button type="button" class="btn btn-default btn-md">
												{{ record.name_comun }}
											</button>
										</li>
										<li v-for="(comun_name, comun_name_index) in record.garden_comun_names"><button type="button" class="btn btn-default btn-md">{{ comun_name.name }}</button></li>
									</ul>
								</div>
							</template>
							
							<br />
							<div class="">
								<h2>Color(es)</h2>
								<ul class="list-inline prod_color">
									<template v-if="record.garden_attributes.length > 0" v-for="(garden_attribute, garden_attribute_index) in record.garden_attributes">
										<li v-if="garden_attribute.filter.tag === 'color' && garden_attribute.filter.type === 'color'" v-for="(attribute, attribute_index) in garden_attribute.filter.attributes">
											<div data-toggle="tooltip" data-placement="top" :title="attribute.text" :style="'background-color: ' + attribute.more" class="color"></div>
										</li>
									</template>
								</ul>
							</div>
							<br />							
							<div class="">
								<h2>Hábito(s) Vegetal(es)</h2>
								<ul class="list-inline prod_size">
									<template v-if="record.garden_attributes.length > 0" v-for="(garden_attribute, garden_attribute_index) in record.garden_attributes">
										<li v-if="garden_attribute.filter.tag === 'vegetable_habit' && garden_attribute.filter.type === 'text'" v-for="(attribute, attribute_index) in garden_attribute.filter.attributes">
											<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" :title="attribute.text">
												{{ attribute.text }}
											</button>
										</li>
									</template>
								</ul>
							</div>
							<br />
							<div class="">
								<h2>Ciclo(s) Vital(es)</h2>
								<ul class="list-inline prod_size">
									<template v-if="record.garden_attributes.length > 0" v-for="(garden_attribute, garden_attribute_index) in record.garden_attributes">
										<li v-if="garden_attribute.filter.tag === 'life_cycle' && garden_attribute.filter.type === 'text'" v-for="(attribute, attribute_index) in garden_attribute.filter.attributes">
											<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" :title="attribute.text">
												{{ attribute.text }}
											</button>
										</li>
									</template>
								</ul>
							</div>
							<br />
							<div class="">
								<h2>Para interior</h2>
								<ul class="list-inline prod_size">
									<template v-if="record.garden_attributes.length > 0" v-for="(garden_attribute, garden_attribute_index) in record.garden_attributes">
										<li v-if="garden_attribute.filter.tag === 'houseplant' && garden_attribute.filter.type === 'binary'" v-for="(attribute, attribute_index) in garden_attribute.filter.attributes">
											<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" :title="attribute.text">
												{{ attribute.text }}
											</button>
											
										</li>
									</template>
								</ul>
							</div>
							<br />
							<div class="">
								<h2>Para exterior</h2>
								<ul class="list-inline prod_size">
									<template v-if="record.garden_attributes.length > 0" v-for="(garden_attribute, garden_attribute_index) in record.garden_attributes">
										<li v-if="garden_attribute.filter.tag === 'externalplant' && garden_attribute.filter.type === 'binary'" v-for="(attribute, attribute_index) in garden_attribute.filter.attributes">
											<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" :title="attribute.text">
												{{ attribute.text }}
											</button>
											
										</li>
									</template>
								</ul>
							</div>
							
							<!-- //
							<br />
							<div class="">
								<div class="product_price">
									<h1 class="price">Ksh80.00</h1>
									<span class="price-tax">Ex Tax: Ksh80.00</span>
									<br>
								</div>
							</div>
							-->
							<!-- //
							<br />
							<div class="">
								<button type="button" class="btn btn-default btn-lg">Add to Cart</button>
								<button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
							</div>
							-->
							<br />
							<div class="">
								<router-link class="btn btn-default btn-lg" :to="{ name: 'Home' }"><i class="fa fa-close"></i> Regresar </router-link>
							</div>
							
							<!-- //
							<div class="product_social">
								<ul class="list-inline">
									<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fa fa-envelope-square"></i></a></li>
									<li><a href="#"><i class="fa fa-rss-square"></i></a></li>
								</ul>
							</div>
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="create">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Crear</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><router-link accesskey="c" class="close-link" :to="{ name: 'Home' }"><i class="fa fa-close"></i></router-link></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
						<div id="wizard-garden" class="form_wizard wizard_horizontal">
							<ul class="wizard_steps">
								<li>
									<a href="#step-1">
										<span class="step_no">1</span>
										<span class="step_descr">
											Paso 1<br />
											<small>Crear el articulo</small>
										</span>
									</a>
								</li>
								<li>
									<a href="#step-2">
										<span class="step_no">2</span>
										<span class="step_descr">
											Paso 2<br />
											<small>Más nombres</small>
										</span>
									</a>
								</li>
								<li>
									<a href="#step-3">
										<span class="step_no">3</span>
										<span class="step_descr">
											Paso 3<br />
											<small>Filtros / Atributos</small>
										</span>
									</a>
								</li>
								<li>
									<a href="#step-4">
										<span class="step_no">4</span>
										<span class="step_descr">
											Paso 4<br />
											<small>Galería</small>
										</span>
									</a>
								</li>
							</ul>
							
							<div id="step-1">
								<div class="col-sm-10 col-xs-12">
									<div class="row">
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_comercial">Nombre comercial <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input @change="validateForm" v-model="record.name_comercial" type="text" id="name_comercial" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_comun">Nombre común <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input @change="validateForm" v-model="record.name_comun" type="text" id="name_comun" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_botanico">Nombre botanico <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input @change="validateForm" v-model="record.name_botanico" type="text" id="name_botanico" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_comun">Imagen Principal <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="input-group">
														<span class="input-group-btn">
															<span class="btn btn-default btn-file">
																Subir… <input type="file" accept="image/png, image/jpeg, image/gif" id="imgInp">
															</span>
														</span>
														<input id='urlname'type="text" class="form-control" readonly>
														<input @change="validateForm" v-model="record.picture" type="hidden" id="picture" required="required" class="form-control col-md-7 col-xs-12">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_botanico">Descripcion <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<textarea @change="validateForm" v-model="record.description" rows="7" id="description" class="form-control col-xs-12" type="text" name="description"></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_botanico">Cuidado(s) <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<textarea @change="validateForm" v-model="record.attendance" rows="7" id="attendance" class="form-control col-xs-12" type="text" name="attendance"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-2 col-xs-12">
									<img id='img-upload'/>
									<button id="clear" class="btn btn-default">Quitar</button>
								</div>
							</div>
							<div id="step-2">
								<h2 class="StepTitle">Agregar más nombres</h2>
								<div class="row">
									<div class="col-xs-12" style="min-height:350px">
										<table class="table">
											<thead>
												<tr>
													<th></th>
													<th width="10"></th>
													<th width="10">
														<button @click="garden_comun_names.push('')" class="btn btn-sm btn-primary  mb-2">
															<i class="fa fa-plus"></i>
														</button>
													</th>
												</tr>
											</thead>
											<tbody v-for="(comun_name, comun_name_index) in garden_comun_names">
												<tr>
													<td>
														<input style="width: 100%" v-model="garden_comun_names[comun_name_index]" type="text" class="form-control" id="field-name" placeholder="Nuevo nombre...." />
													</td>
													<td>
														<button @click="garden_comun_names.splice(comun_name_index, 1)" class="btn btn-sm btn-danger  mb-2" data-role="remove">
															<i class="fa fa-minus"></i>
														</button>
													</td>
													<td>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div id="step-3">
								<h2 class="StepTitle">Filtros y Atributos</h2>
								<p>
									{{ garden_attributes }}
								</p>
								
								<div class="row" style="min-height: 750px">
									<template v-if="options.filters.length > 0">
										<div class="col-xs-12" v-for="(filter, filter_index) in options.filters">
											<table class="table">
												<tr>
													<td width="25%" :title="filter.description">{{ filter.name }}</td>
													<td>
														<div class="checkbox col-xs-12" v-for="(attr, attr_index) in filter.garden_filters_attributes">
															<label>
																<input v-model="garden_attributes" :value="{ filter: filter.id, attribute: attr.id  }" type="checkbox" class="flat">
																<template v-if="filter.type === 'color'">
																	<span class="btn btn-xs btn-default" :style="'color: ' + attr.more">{{ attr.text }}</span>
																</template>
																<template v-else>
																	{{ attr.text }}
																</template>
															</label>
														</div>
													</td>
												</tr>
											</table>
										</div>
									</template>
									<template v-else>
										No hay filtros disponibles
									</template>
								</div>
							</div>
							<div id="step-4">
								<h2 class="StepTitle">Más imagenes</h2>
								<hr />
								  <div class="x_content">
									<div class="col-md-10 col-xs-12">
										<div class="row">
											<div>
												<label class="newbtn">
													<img id="blah" src="//placehold.it/240x240" >
													<input id="pic" class='pis' @change="readURL()" type="file" >
												</label>
											</div>
										</div>
									</div>
									<br />
								  </div>
								<hr />
								<div class="row">
									<div class="col-md-55" v-for="(gallery, gallery_index) in garden_gallery">
										<div class="thumbnail">
											<div class="image view view-first">
												<img :src="'data:image/png;base64, ' + gallery.data" style="width: 100%; display: block;" />
												<!-- //
												<div class="mask">
													<p>Your Text</p>
													<div class="tools tools-bottom">
														<a href="#"><i class="fa fa-link"></i></a>
														<a href="#"><i class="fa fa-pencil"></i></a>
														<a href="#"><i class="fa fa-times"></i></a>
													</div>
												</div>
												-->
											</div>
											<div class="caption">
												<p>
													{{ gallery.name }}
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</template>

<template id="edit">
	<div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Modificar</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><router-link accesskey="c" class="close-link" :to="{ name: 'Single-Details', params: { garden_id: $route.params.garden_id } }"><i class="fa fa-close"></i></router-link></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					
					<div class="x_content">
						<div id="wizard-garden" class="form_wizard wizard_horizontal">
							<ul class="wizard_steps">
								<li>
									<a href="#step-1">
										<span class="step_no">1</span>
										<span class="step_descr">
											Paso 1<br />
											<small>Crear el articulo</small>
										</span>
									</a>
								</li>
								<li>
									<a href="#step-2">
										<span class="step_no">2</span>
										<span class="step_descr">
											Paso 2<br />
											<small>Más nombres</small>
										</span>
									</a>
								</li>
								<li>
									<a href="#step-3">
										<span class="step_no">3</span>
										<span class="step_descr">
											Paso 3<br />
											<small>Filtros / Atributos</small>
										</span>
									</a>
								</li>
								<li>
									<a href="#step-4">
										<span class="step_no">4</span>
										<span class="step_descr">
											Paso 4<br />
											<small>Galería</small>
										</span>
									</a>
								</li>
							</ul>
							<div id="step-1">
								<div class="col-sm-10 col-xs-12">
									<div class="row">
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_comercial">Nombre comercial <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input @change="validateForm" v-model="record.name_comercial" type="text" id="name_comercial" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_comun">Nombre común <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input @change="validateForm" v-model="record.name_comun" type="text" id="name_comun" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_botanico">Nombre botanico <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input @change="validateForm" v-model="record.name_botanico" type="text" id="name_botanico" required="required" class="form-control col-md-7 col-xs-12">
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_comun">Imagen Principal <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="input-group">
														<span class="input-group-btn">
															<span class="btn btn-default btn-file">
																Subir… <input type="file" accept="image/png, image/jpeg, image/gif" id="imgInp">
															</span>
														</span>
														<input id='urlname'type="text" class="form-control" readonly>
														<input @change="validateForm" v-model="record.picture" type="hidden" id="picture" required="required" class="form-control col-md-7 col-xs-12">
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_botanico">Descripcion <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<textarea @change="validateForm" v-model="record.description" rows="7" id="description" class="form-control col-xs-12" type="text" name="description"></textarea>
												</div>
											</div>
										</div>
										<div class="col-md-2 col-xs-12"></div>
										<div class="col-md-10 col-xs-12">
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name_botanico">Cuidado(s) <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<textarea @change="validateForm" v-model="record.attendance" rows="7" id="attendance" class="form-control col-xs-12" type="text" name="attendance"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-2 col-xs-12">
									<img id='img-upload'/>
									<button id="clear" class="btn btn-default">Quitar</button>
								</div>
							</div>
							<div id="step-2">
								<h2 class="StepTitle">Agregar más nombres</h2>
								<div class="row">
									<div class="col-xs-12" style="min-height:350px">
										<table class="table">
											<thead>
												<tr>
													<th></th>
													<th width="10">
														<button @click="garden_comun_names.push('')" class="btn btn-sm btn-primary  mb-2">
															<i class="fa fa-plus"></i>
														</button>
													</th>
												</tr>
											</thead>
											<tbody v-for="(comun_name, comun_name_index) in garden_comun_names">
												<tr>
													<td><input style="width: 100%" v-model="garden_comun_names[comun_name_index]" type="text" class="form-control" id="field-name" placeholder="Nuevo nombre...." /></td>
													<td><button @click="garden_comun_names.splice(comun_name_index, 1)" class="btn btn-sm btn-danger  mb-2" data-role="remove"><i class="fa fa-minus"></i></button></td>
													</tr>
											</tbody>
											<tbody v-for="(comun_name, comun_name_index) in record.garden_comun_names">
												<tr>
													<td>
														<input @change="updComunName(comun_name.id, comun_name.name)" style="width: 100%"  v-model="comun_name.name" type="text" class="form-control" placeholder="Nuevo nombre...." />
													</td>
													<td><button @click="delComunName(comun_name.id, comun_name_index)" class="btn btn-sm btn-danger  mb-2" data-role="remove"><i class="fa fa-trash"></i></button></td>
													</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div id="step-3">
								<h2 class="StepTitle">Filtros y Atributos</h2>
								
								<div class="row" style="min-height: 750px">
									<div class="col-xs-12">
										<h3>Agregar Nuevos</h3>
										<template v-if="options.filters.length > 0">
											<div class="col-xs-12" v-for="(filter, filter_index) in options.filters">
												<table class="table">
													<tr>
														<td width="25%" :title="filter.description">{{ filter.name }}</td>
														<td>
															<div class="checkbox col-xs-12" v-for="(attr, attr_index) in filter.garden_filters_attributes">
																<label>
																	<template v-if="filterExist(attr.id) === true">
																		<button @click="delAttr(filterId(attr.id), filterIndex(attr.id))" class="pull-left btn btn-xs btn-danger">
																			<i class="fa fa-trash"></i>
																		</button>
																	</template>
																	<template v-else>
																		<input v-model="garden_attributes" :value="{ filter: filter.id, attribute: attr.id  }" type="checkbox" class="flat" />
																	</template>
																	
																	
																	<template v-if="filter.type === 'color'">
																		<span class="btn btn-xs btn-default" :style="'color: ' + attr.more">{{ attr.text }}</span>
																	</template>
																	<template v-else>
																		{{ attr.text }}
																	</template>
																	
																</label>
															</div>
														</td>
													</tr>
												</table>
											</div>
										</template>
										<template v-else>
											No hay filtros disponibles
										</template>
									</div>
								</div>
							</div>
							<div id="step-4">
								<h2 class="StepTitle">Más imagenes</h2>
								<hr />
								  <div class="x_content">
									<div class="col-md-10 col-xs-12">
										<div class="row">
											<div>
												<label class="newbtn">
													<img id="blah" src="//placehold.it/240x240" >
													<input id="pic" class='pis' @change="readURL()" type="file" >
												</label>
											</div>
										</div>
									</div>
									<br />
								  </div>
								<hr />
								<div class="row">
									<div class="col-md-55" v-for="(gallery, gallery_index) in record.garden_gallery">
										<div class="thumbnail">
											<div class="image view view-first">
												<img :src="'data:image/png;base64, ' + gallery.picture.data" style="width: 100%; display: block;" />
												<div class="mask">
													<div class="tools tools-bottom">
														<a @click="delPictureGallery(gallery.id, gallery_index)"><i class="fa fa-times"></i></a>
													</div>
												</div>
											</div>
											<div class="caption">
												<p>
													{{ gallery.picture.name }}
												</p>
											</div>
										</div>
									</div>
									<div class="col-md-55" v-for="(gallery, gallery_index) in garden_gallery">
										<div class="thumbnail">
											<div class="image view view-first">
												<img :src="'data:image/png;base64, ' + gallery.data" style="width: 100%; display: block;" />
												<!-- //
												<div class="mask">
													<p>Your Text</p>
													<div class="tools tools-bottom">
														<a href="#"><i class="fa fa-link"></i></a>
														<a href="#"><i class="fa fa-pencil"></i></a>
														<a href="#"><i class="fa fa-times"></i></a>
													</div>
												</div>
												-->
											</div>
											<div class="caption">
												<p>
													{{ gallery.name }}
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>
						</div>
					
				</div>
			</div>
		</div>
	</div>
</template>

<script>
var api = axios.create({
	baseURL: '/api.php',
   withCredentials: true
});

api.interceptors.response.use(function (response) {
  if (response.headers['x-xsrf-token']) {
    document.cookie = 'XSRF-TOKEN=' + response.headers['x-xsrf-token'] + '; path=/';
  }
  return response;
});

function FormException(error, aviso){
	this.name = error;
	this.message = aviso;
};


var Home = Vue.extend({
	template: '#home',
	data(){
		return {
			loading: true,
			temp_filters: [],
			options: {
				filters: [],
			},
			records: [],
			total: 0,
			limit: 20,
			page: 1,
		};
	},
	mounted: function () {
		var self = this;
		self.loadFilters();
	},
	computed: {
		filters(){
			var self = this;
			return [1,2,3];
		}
	},
	methods: {
		loadFilters(){
			// garden_filters
			var self = this;
			self.options.filters = [];
			api.get('/records/garden_filters', { params: {
				join: [
					'garden_filters_attributes',
				]
			} }).then(function (response) {
				if(response.status === 200){
					if(response.data.records !== undefined && response.data.records.length > 0){
						// console.log('Records : ', response.data.records);
						self.options.filters = response.data.records;
						self.load();
					}
				}
			}).catch(function (error) {
				// console.log('error Home::methods::loadFilters()');
				console.log(error.response);
			});
		},
		load(){
			var self = this;
			self.loading = true;
			self.records = [];
			self.total = 0;
			window.scrollTo(0, 0);
			
			if(self.temp_filters.length > 0){
				api.get('/records/garden_attributes', {
					params: {
						filter: [
							'attribute,in,' + self.temp_filters.join(',')
						],
						order: "id",
						page: self.page + "," + self.limit
					}
				}).then(function (response) {
					if(response.status == 200){
						// console.log('respo: ', response);
						list = [];
						
						response.data.records.forEach(function(b){
							const isLargeNumber = (element) => element === b.garden;
							found = list.findIndex(isLargeNumber);
							if(found < 0){
								list.push(b.garden);
							}
						});
						
						api.get('/records/garden', {
							params: {
								join: [
									'pictures',
									'garden_attributes',
								],
								filter: [
									'id,in,' + list.join(',')
								]
							}
						}).then(function (response) {
							if(response.data.records && response.data.records.length > 0){
								self.total = response.data.results;
								self.records = response.data.records;
								self.loading = false;
							}
						}).catch(function (error) {
							console.log('error Home::methods::load()');
							console.log(error.response);
							self.loading = false;
						});
						self.loading = false;
					}
					/*
					if(response.data.records && response.data.records.length > 0){
						self.total = response.data.results;
						self.records = response.data.records;
					}*/
				}).catch(function (error) {
					console.log('error Home::methods::load()');
					console.log(error.response);
					self.loading = false;
				});
			} else {
				api.get('/records/garden', {
					params: {
						join: [
							'pictures',
							'garden_attributes',
						],
						order: "id",
						page: self.page + "," + self.limit
					}
				}).then(function (response) {
					if(response.data.records && response.data.records.length > 0){
						self.total = response.data.results;
						self.records = response.data.records;
						self.loading = false;
					}
					self.loading = false;
				}).catch(function (error) {
					console.log('error Home::methods::load()');
					console.log(error.response);
					self.loading = false;
				});
			}
		},
	}
});

var SingleDetails = Vue.extend({
	template: '#single-details',
	data(){
		return {
			record: {
				"id": this.$route.params.garden_id,
				"name_comercial": "Nombre Comercial",
				"name_comun": "Nombre Comun",
				"name_botanico": "Nombre botanico",
				"picture": {
					"id": 0,
					"name": "",
					"description": "",
					"size": 0,
					"data": "",
					"type": "",
					"created": "",
					"updated": ""
				},
				"description": "",
				"attendance": "",
				"garden_attributes": [],
				"garden_comun_names": [],
				"garden_gallery": [],
			},
			garden_attributes: [],
		};
	},
	computed: {
	},
	mounted() {
		var self = this;
		self.load();
		
	},
	methods: {
		load(){
			var self = this;
			window.scrollTo(0, 0);
			
			api.get('/records/garden/' + self.$route.params.garden_id, {
				params: {
					join: [
						'pictures',
						'garden_gallery,pictures',
						'garden_comun_names',
						'garden_attributes,garden_filters',
						'garden_attributes,garden_filters_attributes',
					]
				}
			}).then(function (response) {
				if(response.status === 200){
					if(response.data.id !== undefined && response.data.id > 0){
						self.garden_attributes = [];
						response.data.garden_attributes.forEach(function(a){
							if(self.garden_attributes[a.filter.tag] == undefined){
								a.filter.attributes = [];
								a.filter.attributes.push(a.attribute);
								self.garden_attributes[a.filter.tag] = a.filter;
							} else {
								self.garden_attributes[a.filter.tag].attributes.push(a.attribute);
							}
						});
						// console.log('self.record.garden_attributes', garden_attributes);
						// response.data.garden_attributes = garden_attributes;
						
						self.record.id = response.data.id;
						self.record.name_comercial = response.data.name_comercial;
						self.record.name_comun = response.data.name_comun;
						self.record.name_botanico = response.data.name_botanico;
						self.record.picture = response.data.picture;
						self.record.description = response.data.description;
						self.record.attendance = response.data.attendance;
						self.record.garden_comun_names = response.data.garden_comun_names;
						self.record.garden_attributes = response.data.garden_attributes;
						self.record.garden_gallery = response.data.garden_gallery;
						$('[data-toggle="tooltip"]').tooltip();
					}
				}
			}).catch(function (error) {
				console.log(error);
				console.log(error.response);
				
				self.$router.push({
					name:'Home'
				});
			});
		},
		deleteThis(){
			var self = this;
			bootbox.confirm({
				message: "Confirma que deseas eliminar este contenido?",
				locale: 'es',
				callback: function (a) {
					if(a !== undefined && a == true){
						api.delete('/records/garden/' + self.$route.params.garden_id)
						.then(function (c){
							if(c.data > 0){
								self.$router.push({
									name:'Home',
								});
								return true;
							}
						})
						.catch(function (e) {
							console.error(e);
							console.log(e.response);
							alert('UPS, Error, intente nuevamente.');
							return false;
						});
					}
				}
			});
		}
	}
});

var Create = Vue.extend({
	template: '#create',
	data(){
		return {
			options: {
				filters: [],
			},
			id: 0,
			record: {
				"name_comercial": "",
				"name_comun": "",
				"name_botanico": "",
				"picture": 0,
				"description": "",
				"attendance": "",
			},
			"garden_attributes": [],
			"garden_comun_names": [],
			"garden_gallery": [],
		};
	},
	mounted() {
		var self = this;
		self.loadFilters();
		window.scrollTo(0, 0);
		// Dynamically add-on fields
		$(function() {
			// Remove button click
			$(document).on(
				'click',
				'[data-role="appendRow"] > .form-inline [data-role="remove"]',
				function(e) {
					e.preventDefault();
					$(this).closest('.form-row').remove();
				}
			);
			// Add button click
			$(document).on(
				'click',
				'[data-role="appendRow"] > .form-row [data-role="add"]',
				function(e) {
					e.preventDefault();
					var container = $(this).closest('[data-role="appendRow"]');
					new_field_group = container.children().filter('.form-row:first-child').clone();
				  new_field_group.find('label').html('Upload Document'); new_field_group.find('input').each(function(){
						$(this).val('');
					});
					container.append(new_field_group);
				}
			);
		});

		// file upload
		$(document).on('change', '.file-upload', function(){
		  var i = $(this).prev('label').clone();
		  var file = this.files[0].name;
		  $(this).prev('label').text(file);
		});

	   /* SMART WIZARD */
	   // https://github.com/Feliphegomez/jQuery-Smart-Wizard
	   $('#wizard-garden').smartWizard({
			// Properties
			selected: 0,  // Selected Step, 0 = first step   
			keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
			enableAllSteps: false,  // Enable/Disable all steps on first load
			transitionEffect: 'slide', // Effect on navigation, none/fade/slide/slideleft
			contentURL:null, // specifying content url enables ajax content loading
			contentURLData:null, // override ajax query parameters
			contentCache:true, // cache step contents, if false content is fetched always from ajax url
			cycleSteps: false, // cycle step navigation
			enableFinishButton: false, // makes finish button enabled always
			hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
			errorSteps:[],    // array of step numbers to highlighting as error steps
			labelNext: 'Continuar', // label for Next button
			labelPrevious: 'Anterior', // label for Previous button
			labelFinish: 'Finalizar',  // label for Finish button        
			noForwardJumping:false,
			ajaxType: 'POST',
			// Events
			onLeaveStep: null, // triggers when leaving a step
			onShowStep: null,  // triggers when showing a step
			onFinish: null,  // triggers when Finish button is clicked  
			buttonOrder: ['finish', 'next', 'prev'],  // button order, to hide a button remove it from the list
			onLeaveStep:leaveAStepCallback,
			onFinish:onFinishCallback,
		});
		
		function leaveAStepCallback(obj, context){
			// alert("Saliendo del paso " + context.fromStep + " para ir al paso " + context.toStep);
			return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
		}
		
		function onFinishCallback(objs, context){
			if(validateAllSteps()){
				//alert('Completado');
				
				self.$router.push({
					name:'Single-Details',
					params: {
						garden_id: self.id
					}
				});
			}
		}
		
		// Your Step validation logic
		function validateSteps(stepnumber){
			var isStepValid = true;
			window.scrollTo(0, 0);
			// validate step 1
			if(stepnumber == 1){
				// Your step validation logic
				// set isStepValid = false if has errors
				if(self.id > 0){
					isStepValid = true;
					return isStepValid;
				} else {
					alert("Rellene el formulario.");
				}
			} else if(stepnumber == 2){
				if(self.garden_comun_names.length > 0){
					// console.log(self.garden_comun_names);
					self.garden_comun_names.forEach(function(f){
						if(f !== ""){
							api.post('/records/garden_comun_names', {
								garden: self.id,
								name: f
							})
							.then(function (g){
								if(g.data > 0){
									 //console.log("Nombre agregado: ", f);
									//console.log("Id: ", g);
								}
							})
						} else {
							
						}
					});
					return isStepValid;
				} else {
					return isStepValid;
				}
			} else if(stepnumber == 3){
				if(self.garden_attributes.length > 0){
					//console.log(self.garden_attributes);
					self.garden_attributes.forEach(function(h){
						if(h !== ""){
							api.post('/records/garden_attributes', {
								garden: self.id,
								filter: h.filter,
								attribute: h.attribute
							})
							.then(function (j){
								if(j.data > 0){
									//console.log("Filtro agregado: ", h);
									//console.log("Id: ", j);
								}
							})
						}
					});
					return isStepValid;
				} else {
					return isStepValid;
				}
			}
		}
		
		function validateAllSteps(){
			var isStepValid = true;
			// all step validation logic     
			return isStepValid;
		}
		
		$('.buttonNext').addClass('btn btn-success');
		$('.buttonPrevious').addClass('btn btn-primary');
		$('.buttonFinish').addClass('btn btn-default');
		
		$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
				var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {
				var input = $(this).parents('.input-group').find(':text'), log = label;
				if (input.length){ input.val(log); } 
				else { if(log) alert(log); }
			});
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						self.record.picture = 0;
						//console.log('input.files[0]', input.files[0]);
						//console.log('e.target', e.target);
						
						pict = {
							name: input.files[0].name,
							size: input.files[0].size,
							data: e.target.result.split('base64,')[1],
							type: input.files[0].type,
						};
						//console.log('pict', pict);
						
						api.post('/records/pictures', pict)
						.then(function (d){
							if(d.data > 0){
								self.record.picture = d.data;
								$('#img-upload').attr('src', e.target.result);
							}
						})
						.catch(function (e) {
							//console.error(e);
							//console.log(e.response);
							$('#img-upload').attr('src','');
							$('#urlname').val('');
							self.record.picture = 0;
						});
					}
					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
			});
			
			$("#clear").click(function(){
				$('#img-upload').attr('src','');
				$('#urlname').val('');
				self.record.picture = 0;
			});
		});
	},
	methods: {
		readURL() {
			var self = this;
			// var input = $("#pic")[0];
			var input = $("#pic");
			//console.log('input', input);
			//console.log('files', input[0].files);
			
			if (input[0].files && input[0].files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
					
					pict = {
						name: input[0].files[0].name,
						size: input[0].files[0].size,
						data: e.target.result.split('base64,')[1],
						type: input[0].files[0].type,
					};
					
					api.post('/records/pictures', pict)
					.then(function (d){
						if(d.data > 0){
							self.record.picture = d.data;
							$('#img-upload').attr('src', e.target.result);
							
							
							api.post('/records/garden_gallery', {
								garden: self.id,
								// garden: 1,
								picture: d.data
							})
							.then(function (z){
								if(z.data > 0){
									// self.record.picture = z.data;
									// $('#blah').attr('src', e.target.result);
									self.garden_gallery.push(pict);
									$('#blah').attr('src', '//placehold.it/240x240');
									$('#pic').val('');
								}
							})
							.catch(function (e) {
								console.error(e);
								console.log(e.response);
								$('#blah').attr('src','');
								$('#pic').val('');
							});
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						$('#blah').attr('src','');
						$('#pic').val('');
					});
				};
				reader.readAsDataURL(input[0].files[0]);
			}
        },
		loadFilters(){
			var self = this;
			api.get('/records/garden_filters', { params: {
				join: [
					'garden_filters_attributes',
				]
			} }).then(function (response) {
				if(response.status === 200){
					if(response.data.records !== undefined && response.data.records.length > 0){
						self.options.filters = response.data.records;
					}
				}
			}).catch(function (error) {
				console.log('error Home::methods::loadFilters()');
				console.log(error.response);
			});
		},
		validateForm(){
			var self = this;
			if(
				self.record.name_comercial.length > 3
				&& self.record.name_comun.length > 3
				&& self.record.name_botanico.length > 3
				&& parseInt(self.record.picture) > 0
				&& self.record.description.length > 3
				&& self.record.attendance.length > 3
			){
				if(self.id <= 0){
					api.post('/records/garden', self.record)
					.then(function (c){
						if(c.data > 0){
							self.id = c.data;
							return true;
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						return false;
					});
				} else {
					api.put('/records/garden/' + self.id, self.record)
					.then(function (c){
						if(c.data > 0){
							return true;
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						return false;
					});
				}
			} else {
				console.log('Formulario incompleto');
			}
		},
	}
});

var Edit = Vue.extend({
	template: '#edit',
	data(){
		return {
			options: {
				filters: [],
			},
			id: 0,
			record: {
				"id": 0,
				"name_comercial": "",
				"name_comun": "",
				"name_botanico": "",
				"picture": 0,
				"description": "",
				"attendance": "",
				"garden_attributes": [],
			},
			"garden_attributes": [],
			"garden_comun_names": [],
			"garden_gallery": [],
		};
	},
	mounted() {
		var self = this;
		self.loadFilters();
		
		api.get('/records/garden/' + self.$route.params.garden_id, { params: {
			join: [
				'garden_gallery,pictures',
				'garden_comun_names',
				'garden_attributes',
			]
		} }).then(function (response) {
			if(response.status === 200){
				if(response.data.id !== undefined && response.data.id > 0){
					self.id = response.data.id;
					/*self.record = {
						"id": response.data.id,
						"name_comercial": response.data.name_comercial,
						"name_comun": response.data.name_comun,
						"name_botanico": response.data.name_botanico,
						"picture": response.data.picture,
						"description": response.data.description,
						"attendance": response.data.attendance,
					};*/
					self.record = response.data;
					//self.garden_attributes = response.data.garden_attributes;
					//self.garden_comun_names = response.data.garden_comun_names;
					//self.garden_gallery = response.data.garden_gallery;
					
										
					// this.$route.params.garden_id,
					// Dynamically add-on fields
					$(function() {
						// Remove button click
						$(document).on(
							'click',
							'[data-role="appendRow"] > .form-inline [data-role="remove"]',
							function(e) {
								e.preventDefault();
								$(this).closest('.form-row').remove();
							}
						);
						// Add button click
						$(document).on(
							'click',
							'[data-role="appendRow"] > .form-row [data-role="add"]',
							function(e) {
								e.preventDefault();
								var container = $(this).closest('[data-role="appendRow"]');
								new_field_group = container.children().filter('.form-row:first-child').clone();
							  new_field_group.find('label').html('Upload Document'); new_field_group.find('input').each(function(){
									$(this).val('');
								});
								container.append(new_field_group);
							}
						);
					});

					// file upload
					$(document).on('change', '.file-upload', function(){
					  var i = $(this).prev('label').clone();
					  var file = this.files[0].name;
					  $(this).prev('label').text(file);
					});

				   /* SMART WIZARD */
				   // https://github.com/Feliphegomez/jQuery-Smart-Wizard
				   $('#wizard-garden').smartWizard({
						// Properties
						selected: 0,  // Selected Step, 0 = first step   
						keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
						enableAllSteps: false,  // Enable/Disable all steps on first load
						transitionEffect: 'slide', // Effect on navigation, none/fade/slide/slideleft
						contentURL:null, // specifying content url enables ajax content loading
						contentURLData:null, // override ajax query parameters
						contentCache:true, // cache step contents, if false content is fetched always from ajax url
						cycleSteps: false, // cycle step navigation
						enableFinishButton: false, // makes finish button enabled always
						hideButtonsOnDisabled: false, // when the previous/next/finish buttons are disabled, hide them instead
						errorSteps:[],    // array of step numbers to highlighting as error steps
						labelNext: 'Continuar', // label for Next button
						labelPrevious: 'Anterior', // label for Previous button
						labelFinish: 'Finalizar',  // label for Finish button        
						noForwardJumping:false,
						ajaxType: 'POST',
						// Events
						onLeaveStep: null, // triggers when leaving a step
						onShowStep: null,  // triggers when showing a step
						onFinish: null,  // triggers when Finish button is clicked  
						buttonOrder: ['finish', 'next', 'prev'],  // button order, to hide a button remove it from the list
						onLeaveStep:leaveAStepCallback,
						onFinish:onFinishCallback,
					});
					
					function leaveAStepCallback(obj, context){
						// alert("Saliendo del paso " + context.fromStep + " para ir al paso " + context.toStep);
						return validateSteps(context.fromStep); // return false to stay on step and true to continue navigation 
					}
					
					function onFinishCallback(objs, context){
						if(validateAllSteps()){
							//alert('Completado');
							
							self.$router.push({
								name:'Single-Details',
								params: {
									garden_id: self.id
								}
							});
						}
					}
					
					// Your Step validation logic
					function validateSteps(stepnumber){
						window.scrollTo(0, 0);
						var isStepValid = true;
						// validate step 1
						if(stepnumber == 1){
							// Your step validation logic
							// set isStepValid = false if has errors
							if(self.id > 0){
								isStepValid = true;
								return isStepValid;
							} else {
								alert("Rellene el formulario.");
							}
						} else if(stepnumber == 2){
							if(self.garden_comun_names.length > 0){
								/// console.log(self.garden_comun_names);
								self.garden_comun_names.forEach(function(f){
									if(f !== ""){
										api.post('/records/garden_comun_names', {
											garden: self.id,
											name: f
										})
										.then(function (g){
											if(g.data > 0){
												//console.log("Nombre agregado: ", f);
												//console.log("Id: ", g);
											}
										})
									} else {
										
									}
								});
								return isStepValid;
							} else {
								return isStepValid;
							}
						} else if(stepnumber == 3){
							if(self.garden_attributes.length > 0){
								//console.log(self.garden_attributes);
								self.garden_attributes.forEach(function(h){
									if(h !== ""){
										api.post('/records/garden_attributes', {
											garden: self.id,
											filter: h.filter,
											attribute: h.attribute
										})
										.then(function (j){
											if(j.data > 0){
												//console.log("Filtro agregado: ", h);
												//console.log("Id: ", j);
											}
										})
									}
								});
								return isStepValid;
							} else {
								return isStepValid;
							}
						}
					}
					
					function validateAllSteps(){
						var isStepValid = true;
						// all step validation logic     
						return isStepValid;
					}
					
					$('.buttonNext').addClass('btn btn-success');
					$('.buttonPrevious').addClass('btn btn-primary');
					$('.buttonFinish').addClass('btn btn-default');
					
					$(document).ready( function() {
						$(document).on('change', '.btn-file :file', function() {
							var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
							input.trigger('fileselect', [label]);
						});

						$('.btn-file :file').on('fileselect', function(event, label) {
							var input = $(this).parents('.input-group').find(':text'), log = label;
							if (input.length){ input.val(log); } 
							else { if(log) alert(log); }
						});
						
						function readURL(input) {
							if (input.files && input.files[0]) {
								var reader = new FileReader();
								reader.onload = function (e) {
									self.record.picture = 0;
									//console.log('input.files[0]', input.files[0]);
									//console.log('e.target', e.target);
									
									pict = {
										name: input.files[0].name,
										size: input.files[0].size,
										data: e.target.result.split('base64,')[1],
										type: input.files[0].type,
									};
									//console.log('pict', pict);
									
									api.post('/records/pictures', pict)
									.then(function (d){
										if(d.data > 0){
											self.record.picture = d.data;
											$('#img-upload').attr('src', e.target.result);
										}
									})
									.catch(function (e) {
										console.error(e);
										console.log(e.response);
										$('#img-upload').attr('src','');
										$('#urlname').val('');
										self.record.picture = 0;
									});
								}
								reader.readAsDataURL(input.files[0]);
							}
						}

						$("#imgInp").change(function(){
							readURL(this);
						});
						
						$("#clear").click(function(){
							$('#img-upload').attr('src','');
							$('#urlname').val('');
							self.record.picture = 0;
						});
					});

				}
			}
		}).catch(function (error) {
			console.log('error Home::methods::loadFilters()');
			console.log(error.response);
		});
	},
	methods: {
		delPictureGallery(gallery_id, index){
			var self = this;
			console.log('delPictureGallery');
			console.log(gallery_id, index);
			bootbox.confirm({
				message: "Confirma que deseas eliminar este contenido?",
				locale: 'es',
				callback: function (a) {
					if(a !== undefined && a == true){
						api.delete('/records/garden_gallery/' + gallery_id)
						.then(function (c){
							// console.log('c', c);
							if(c.data > 0){
								self.record.garden_gallery.splice(index, 1);
								return true;
							}
						})
						.catch(function (e) {
							console.error(e);
							console.log(e.response);
							return false;
						});
					}
				}
			});
		},
		delAttr(attribute_id, index){
			var self = this;
			
			//console.log('delComunName');
			//console.log(attribute_id, index);
			bootbox.confirm({
				message: "Confirma que deseas eliminar este contenido?",
				locale: 'es',
				callback: function (a) {
					if(a !== undefined && a == true){
						api.delete('/records/garden_attributes/' + attribute_id)
						.then(function (c){
							// console.log('c', c);
							if(c.data > 0){
								self.record.garden_attributes.splice(index, 1);
								return true;
							}
						})
						.catch(function (e) {
							console.error(e);
							console.log(e.response);
							return false;
						});
					}
				}
			});
		},
		filterExist(attribute_id){
			var self = this;
			resultado = self.record.garden_attributes.find( attr => attr.attribute === attribute_id ) !== undefined;
			return resultado;
		},
		filterId(attribute_id){
			var self = this;
			resultado = self.record.garden_attributes.find( attr => attr.attribute === attribute_id ) !== undefined;
			if(resultado){
				resultado2 = self.record.garden_attributes.find( attr => attr.attribute === attribute_id );
				return resultado2.id;
			} else {
				return 0;
			}
		},
		filterIndex(attribute_id){
			var self = this;
			resultado = self.record.garden_attributes.find( attr => attr.attribute === attribute_id ) !== undefined;
			if(resultado){
				resultado2 = self.record.garden_attributes.findIndex( attr => attr.attribute === attribute_id );
				return resultado2;
			} else {
				return 0;
			}
		},
		readURL() {
			var self = this;
			// var input = $("#pic")[0];
			var input = $("#pic");
			//console.log('input', input);
			//console.log('files', input[0].files);
			
			if (input[0].files && input[0].files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#blah').attr('src', e.target.result);
					
					pict = {
						name: input[0].files[0].name,
						size: input[0].files[0].size,
						data: e.target.result.split('base64,')[1],
						type: input[0].files[0].type,
					};
					
					api.post('/records/pictures', pict)
					.then(function (d){
						if(d.data > 0){
							self.record.picture = d.data;
							$('#img-upload').attr('src', e.target.result);
							
							
							api.post('/records/garden_gallery', {
								garden: self.id,
								// garden: 1,
								picture: d.data
							})
							.then(function (z){
								if(z.data > 0){
									// self.record.picture = z.data;
									// $('#blah').attr('src', e.target.result);
									self.garden_gallery.push(pict);
									$('#blah').attr('src', '//placehold.it/240x240');
									$('#pic').val('');
								}
							})
							.catch(function (e) {
								console.error(e);
								console.log(e.response);
								$('#blah').attr('src','');
								$('#pic').val('');
							});
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						$('#blah').attr('src','');
						$('#pic').val('');
					});
				};
				reader.readAsDataURL(input[0].files[0]);
			}
        },
		loadFilters(){
			var self = this;
			api.get('/records/garden_filters', { params: {
				join: [
					'garden_filters_attributes',
				]
			} }).then(function (response) {
				if(response.status === 200){
					if(response.data.records !== undefined && response.data.records.length > 0){
						self.options.filters = response.data.records;
					}
				}
			}).catch(function (error) {
				console.log('error Home::methods::loadFilters()');
				console.log(error.response);
			});
		},
		validateForm(){
			var self = this;
			if(
				self.record.name_comercial.length > 3
				&& self.record.name_comun.length > 3
				&& self.record.name_botanico.length > 3
				&& parseInt(self.record.picture) > 0
				&& self.record.description.length > 3
				&& self.record.attendance.length > 3
			){
				if(self.id <= 0){
					api.post('/records/garden', self.record)
					.then(function (c){
						if(c.data > 0){
							self.id = c.data;
							return true;
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						return false;
					});
				} else {
					api.put('/records/garden/' + self.id, self.record)
					.then(function (c){
						if(c.data > 0){
							return true;
						}
					})
					.catch(function (e) {
						console.error(e);
						console.log(e.response);
						return false;
					});
				}
			} else {
				console.log('Formulario incompleto');
			}
		},
		updComunName(id, textnew){
			var self = this;
			//console.log('updComunName');
			//console.log(id, textnew);
			api.put('/records/garden_comun_names/' + id, {
				id: id,
				garden: self.id,
				name: textnew
			})
			.then(function (c){
				// console.log('c', c);
				if(c.data > 0){
					return true;
				}
			})
			.catch(function (e) {
				console.error(e);
				console.log(e.response);
				return false;
			});
		},
		delComunName(id, index){
			var self = this;
			//console.log('delComunName');
			//console.log(id, index);
			bootbox.confirm({
				message: "Confirma que deseas eliminar este contenido?",
				locale: 'es',
				callback: function (a) {
					if(a !== undefined && a == true){
						api.delete('/records/garden_comun_names/' + id)
						.then(function (c){
							// console.log('c', c);
							if(c.data > 0){
								self.record.garden_comun_names.splice(index, 1);
								return true;
							}
						})
						.catch(function (e) {
							console.error(e);
							console.log(e.response);
							return false;
						});
					}
				}
			});
		},
	}
});

var router = new VueRouter({
	linkActiveClass: 'active',
	routes:[
		<?= 
			(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden') == true)) ? 
				"{ path: '/', component: Home, name: 'Home' },"
			: "";
		?>
		<?= 
			(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden_create') == true)) ? 
				"{ path: '/create', component: Create, name: 'Create' },"
			: "";
		?>
		<?= 
			(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden') == true)) ? 
				"{ path: '/view/:garden_id', component: SingleDetails, name: 'Single-Details' },"
			: "";
		?>
		<?= 
			(($this->checkPermission('libraries:garden_admin') == true) || ($this->checkPermission('libraries:garden_edit') == true)) ? 
				"{ path: '/edit/:garden_id', component: Edit, name: 'Edit-Details' },"
			: "";
		?>
	]
});

app = new Vue({
	router: router,
	data: function () {
		return {

		};
	},
	methods: {
		zfill(number, width) {
			var numberOutput = Math.abs(number);
			var length = number.toString().length;
			var zero = "0";
			if (width <= length) {
				if (number < 0) { return ("-" + numberOutput.toString()); }
				else { return numberOutput.toString(); }
			} else {
				if (number < 0) { return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); }
				else { return ((zero.repeat(width - length)) + numberOutput.toString()); }
			}
		}
	}
}).$mount('#garden-app');
</script>
