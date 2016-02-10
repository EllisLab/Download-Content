<?php
/*
Copyright (C) 2011-2016 EllisLab, Inc.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
ELLISLAB, INC. BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Except as contained in this notice, the name of EllisLab, Inc. shall not be
used in advertising or otherwise to promote the sale, use or other dealings
in this Software without prior written authorization from EllisLab, Inc.
*/

/**
 * Download_content Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			EllisLab Dev Team
 * @copyright		Copyright (c) 2011 - 2016, EllisLab, Inc.
 * @link			https://ellislab.com
 */
class Download_content {

	/**
	 * @var return data from the constructor (unused, but expected in the interface)
	 */
	public $return_data;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$data = trim(ee()->TMPL->tagdata);
		$filename = ee()->TMPL->fetch_param('filename');
		$save_path = ee()->TMPL->fetch_param('save_to_server_path');

		if ($filename == '')
		{
			ee()->TMPL->log_item('Download Content: No filename given, aborting download');
			return FALSE;
		}

		// do some final prep on the tagdata
		$data = ee()->TMPL->advanced_conditionals($data);
		$data = ee()->TMPL->parse_globals($data);

		// cleanup any stray annotations or comments
		$data = preg_replace("/\{!--.*?--\}/s", '', $data);

		if ($save_path !== FALSE)
		{
			$path = realpath($save_path);

			if ( ! @is_dir($path))
			{
				if ( ! @mkdir($path) OR ! is_really_writeable($path))
				{
					ee()->TMPL->log_item('Download Content: Save path does not exist, could not create, or is not writeable: '.htmlentities($save_path));
					return FALSE;
				}
			}

			ee()->load->helper('file');
			write_file($path.'/'.$filename, $data);
		}

		ee()->load->helper('download');
		force_download($filename, $data);
	}

// --------------------------------------------------------------------

}
// END CLASS

// EOF
