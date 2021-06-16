<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    /**
     * PDF filename
     * @var String
     */
    /**
     * PDF filename
     * @var String
     */

    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access	public
     * @param	string	$view The view to load
     * @param	array	$data The view data
     * @return	void
     */
    public function generate($html)
    {
        $this->loadHtml($html);
        $this->render();
        $this->stream($this->filename, array("Attachment" => 0));
    }
}
