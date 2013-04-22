<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['inscricao-oficina/(:any)'] = "ilhaDesignController/inscricaoAluno/$1/$2/$3/$4/$5";

$route['escolhe-oficinas'] = "ilhaDesignController/novoAluno";

$route['procura-aluno'] = "ilhaDesignController/verificaAluno";

$route['login'] = "ilhaDesignController/login";
$route['logout'] = "ilhaDesignController/logout";
$route['verifica-login'] = "ilhaDesignController/verificaLogin";

$route['edita-local/(:any)'] = 'ilhaDesignController/editaLocal/$1';
$route['edita-oficina/(:any)'] = 'ilhaDesignController/editaOficina/$1';
$route['edita-tipo-oficina/(:any)'] = 'ilhaDesignController/editaTipoOficina/$1';
$route['edita-inscricao/(:any)'] = 'ilhaDesignController/editaInscricao/$1';

$route['exclui-local/(:any)'] = 'ilhaDesignController/excluiLocal/$1';
$route['exclui-oficina/(:any)'] = 'ilhaDesignController/excluiOficina/$1';
$route['exclui-tipo-oficina/(:any)'] = 'ilhaDesignController/excluiTipoOficina/$1';
$route['exclui-inscricao/(:any)'] = 'ilhaDesignController/excluiInscricao/$1';

$route['cria-local'] = 'ilhaDesignController/criaLocal';
$route['cria-oficina'] = 'ilhaDesignController/criaOficina';
$route['cria-tipo-oficina'] = 'ilhaDesignController/criaTipoOficina';
$route['cria-inscricao'] = 'ilhaDesignController/criaInscricao';


$route['gerencia-locais'] = 'ilhaDesignController/gerenciaLocais';
$route['gerencia-oficina'] = 'ilhaDesignController/gerenciaOficina';
$route['gerencia-tipo-oficina'] = 'ilhaDesignController/gerenciaTipoOficina';
$route['gerencia-inscricao'] = 'ilhaDesignController/gerenciaInscricao';

$route['gerencia'] = 'ilhaDesignController/gerencia';

$route['default_controller'] = 'ilhaDesignController';
//$route['(:any)'] = 'IlhaDesignController/view/$1';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */