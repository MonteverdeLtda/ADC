<?php 
/* *******************************
 *
 * Developer by FelipheGomez
 *
 * ******************************/

class DemoController extends ControladorBase{
    public function __construct() {
        parent::__construct([
			"theme" => "demo"
		]);
    }
    
	// Paneles / Dashboard
    public function actionIndex(){
        $this->render("index", [
			"title" => "Panel 1",
            "description" => "Ingrese su contenido..."
        ]);
    }
    public function actionIndex2(){ $this->render("index2", [ "title" => "Panel 2" ]); }
    public function actionIndex3(){ $this->render("index3", [ "title" => "Panel 3" ]); }
	
	// Formularios
    public function actionForm(){ $this->render("form", [ "title" => "Formulario Básico" ]); }
    public function actionForm_advanced(){ $this->render("form_advanced", [ "title" => "Formulario Avanzado" ]); }
    public function actionForm_validation(){ $this->render("form_validation", [ "title" => "Validacion de Formulario" ]); }
    public function actionForm_wizards(){ $this->render("form_wizards", [ "title" => "Asistente de Formulario" ]); }
    public function actionForm_upload(){ $this->render("form_upload", [ "title" => "Carga de archivos" ]); }
    public function actionForm_buttons(){ $this->render("form_buttons", [ "title" => "Botones de formulario" ]); }
	
	// Elementos IU
    public function actionGeneral_elements(){ $this->render("general_elements", [ "title" => "Elementos generales" ]); }
    public function actionMedia_gallery(){ $this->render("media_gallery", [ "title" => "Galería de medios" ]); }
    public function actionTypography(){ $this->render("typography", [ "title" => "Tipografía" ]); }
    public function actionIcons(){ $this->render("icons", [ "title" => "Iconos" ]); }
    public function actionGlyphicons(){ $this->render("glyphicons", [ "title" => "Iconos glyphicons" ]); }
    public function actionWidgets(){ $this->render("widgets", [ "title" => "Widgets" ]); }
    public function actionInvoice(){ $this->render("invoice", [ "title" => "Factura" ]); }
    public function actionInbox(){ $this->render("inbox", [ "title" => "Bandeja de entrada" ]); }
    public function actionCalendar(){ $this->render("calendar", [ "title" => "Calendario" ]); }
    public function actionTables(){ $this->render("tables", [ "title" => "Tablas" ]); }
    public function actionTables_dynamic(){ $this->render("tables_dynamic", [ "title" => "Tablas dinamicas" ]); }
	
	// Presentación de datos
    public function actionChartjs(){ $this->render("chartjs", [ "title" => "Chartjs" ]); }
    public function actionChartjs2(){ $this->render("chartjs2", [ "title" => "Chartjs 2" ]); }
    public function actionMorisjs(){ $this->render("morisjs", [ "title" => "Morisjs" ]); }
    public function actionEcharts(){ $this->render("echarts", [ "title" => "Echarts" ]); }
    public function actionOther_charts(){ $this->render("other_charts", [ "title" => "Otros" ]); }
	
	// Diseños
    public function actionFixed_sidebar(){
		$this->theme['default'] = 'demo-2';
		$this->render("fixed_sidebar", [ "title" => "barra lateral fija" ]);
	}
    public function actionFixed_footer(){
		$this->theme['default'] = 'demo-3';
		$this->render("fixed_footer", [ "title" => "Pie de Pagina fijo" ]);
	}
    
	// Páginas adiccionales
    public function actionE_commerce(){ $this->render("e_commerce", [ "title" => "E-Commerce" ]); }
    public function actionProjects(){ $this->render("projects", [ "title" => "Projectos" ]); }
    public function actionProject_detail(){ $this->render("project_detail", [ "title" => "Detalles del Projecto" ]); }
    public function actionContacts(){ $this->render("contacts", [ "title" => "contactos" ]); }
    public function actionProfile(){ $this->render("profile", [ "title" => "Perfiles" ]); }
	
	// Extras
    public function actionPage_403(){
		$this->theme['default'] = 'demo-errors';
		$this->render("page_403", [ "title" => "Error 403" ]);
	}
    public function actionPage_404(){
		$this->theme['default'] = 'demo-errors';
		$this->render("page_404", [ "title" => "Error 404" ]);
	}
    public function actionPage_500(){
		$this->theme['default'] = 'demo-errors';
		$this->render("page_500", [ "title" => "Error 500" ]);
	}
    public function actionPlain_page(){ $this->render("plain_page", [ "title" => "Página normal" ]); }
    public function actionLogin(){
		$this->theme['default'] = 'demo-login';
		$this->render("login", [ "title" => "Formulario ingreso" ]);
    }
    public function actionPricing_tables(){
		$this->render("pricing_tables", [ "title" => "Tabla de precios" ]);
    }
    
    public function actionDemoPHPStrap(){
        // DOCS: https://maxtuni.es/PHPStrap/namespaces/PHPStrap.html
        // https://maxtuni.es/PHPStrap/
        $ExamplePanelX = new PHPStrap\PanelX();
        $ExamplePanelX->addHeader("Plain Page");
        $ExamplePanelX->addButton((PHPStrap\Util\Html::tag('a', (PHPStrap\Util\Html::tag('i', '', 'fa fa-chevron-up')), 'collapse-link')));
        $ExamplePanelX->addButton((PHPStrap\Util\Html::tag('a', (PHPStrap\Util\Html::tag('i', '', 'fa fa-close')), 'close-link')));
        $ExamplePanelX->addContent("Add content to the page ...");
        
        $ExamplePanel = new PHPStrap\Panel();
        $ExamplePanel->addHeader("Example panel");
        $ExamplePanel->addContent("My content");
        
        $ExampleListGroup = new PHPStrap\ListGroup();
        $ExampleListGroup->addItem("First item");
        $ExampleListGroup->addItem("Active item", TRUE);
        $ExampleListGroup->addLink("Linked item", "https://github.com/Feliphegomez/");
        
        $Row = new PHPStrap\Row();
        $Row->addColumn($ExamplePanelX);
        $Row->addColumn($ExamplePanelX);
        $Row->addColumn($ExampleListGroup);
        $Row->addColumn($ExamplePanel);
        $ExampleWell = new PHPStrap\Well($Row);
        
        $this->render("blank_page", [
            "description" => $ExamplePanelX.$ExamplePanel.$ExampleListGroup.$ExampleWell
        ]);
    }
}
?>
