<?php
/**
 * Edited Cologne Blue: A nicer-looking alternative to Standard.
 *
 * @todo document
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

/**
 * @todo document
 * @ingroup Skins
 */
class SkinCologneBlue extends SkinLegacy {
	var $skinname = 'cologneblue', $stylename = 'cologneblue',
		$template = 'CologneBlueTemplate';

	/**
	 * @param $out OutputPage
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( 'skins.cologneblue' );
		$out->addInlineStyle( $style, 'flip' );
	}

}

class CologneBlueTemplate extends LegacyTemplate {

	/**
	 * @return string
	 */
	function doBeforeContent() {
		$mainPageObj = Title::newMainPage();

		$s = "\n\n<div class=\"wrapper\">";
		$s .="\n\t<div class=\"headcontainer\">";
		$s .= "\n\t\t<div class=\"section group\">";

		$s .="\n\t\t\t<div class=\"col sitelogocontainer\">";
		$s .= "\n\t\t\t\t<a href=\"" . htmlspecialchars( $mainPageObj->getLocalURL() ) . '">';
		$s .= '<img src=/skins/common/GaelForce.png></a>';
		$s .= "\n\t\t\t</div>";

		$s .= "\n\t\t\t<div class=\"col sitetitlecontainer\">";
                $s .= "\n\t\t\t\t<a href=\"" . htmlspecialchars( $mainPageObj->getLocalURL() ) . '" class="sitetitle">';
		$s .= wfMsg( 'sitetitle' ) . "</a>\n\t\t\t</div>";

		$s .= "\n\t\t\t<div class=\"col siteinfocontainer\">";
		$s .= "\n\t\t\t\t<div class=\"siteinfo\">";
		$s .= "Online</div>\n\t\t\t\t<div class=\"siteinfo\">Notebook</div>";
		$s .= "\n\t\t\t</div>";

		$s .= "\n\t\t\t<div class=\"col rightnavcontainer\">";
		$s .= "\n\t\t\t\t<div class=\"syslinks\">";
		$s .= $this->sysLinks() . "</div>";
		$s .= "\n\t\t\t\t<div class=\"searchbar\">" . $this->searchForm();
		$s .= "</div>";
		$s .= "\n\t\t\t</div>";

		$s .= "\n\t\t</div>\n\t</div>";

		$s .= "\n\t</div class=\"maincontentcontainer\">";
		$s .= "\n\t\t<div class=\"section group\">";

		$s .= "\n\t\t\t<div class=\"col quickbarcontainer\">";
		if ( $this->getSkin()->qbSetting() != 0 ) {
                        $s .= $this->quickBar();
                }

		$s .= "\t\t\t<div class=\"col articlecontainer\">\n\t\t\t\t";

		$s .= $this->pageTitle();
		return $s;
	}

	/**
	 * @return string
	 */
	function doAfterContent(){
		$s = "\n\n\n\t\t\t</div><!-- Ends article-->\n\t\t</div><!-- Ends section group-->\n\t</div><!-- Ends main content container -->";

		$s .= "\n\t<div class=\"footercontainer\">\n\t\t<div class=\"section group\">";
		$s .= "\n\t\t\t<footer class=\"group\">";

		$s .= $this->getSkin()->getLanguage()->pipeList( array(
				Linker::link(
				Title::newMainPage(),
				null,
				array(),
				array(),
				array( 'known', 'noclasses' )
			),
			$this->getSkin()->aboutLink(),
		) );

		$s .= "<br><br>\n\t\t\t\t\t" . $this->pageStats();

		$s .= "\n\t\t\t</footer>\n\t\t<div>\n\t<div>\n</div>\n\n\n";


		return $s;
	}

	/**
	 * @return string
	 */
	function sysLinks() {
		$li = SpecialPage::getTitleFor( 'Userlogin' );
		$lo = SpecialPage::getTitleFor( 'Userlogout' );

		$rt = $this->getSkin()->getTitle()->getPrefixedURL();
		if ( 0 == strcasecmp( urlencode( $lo ), $rt ) ) {
			$q = array();
		} else {
			$q = array( 'returnto' => $rt );
		}

		$s = array(
			$this->getSkin()->mainPageLink(),
			Linker::linkKnown(
				Title::newFromText( wfMsgForContent( 'aboutpage' ) ),
				wfMsg( 'about' )
			),
		);

		if ( $this->data['loggedin'] ) {
			$s[] = Linker::linkKnown(
				$lo,
				wfMsg( 'logout' ),
				array(),
				$q
			);
		} else {
			$s[] = Linker::linkKnown(
				$li,
				wfMsg( 'login' ),
				array(),
				$q
			);
		}
		return $this->getSkin()->getLanguage()->pipeList( $s );
	}

	/**
	 * Compute the sidebar
	 * @access private
	 *
	 * @return string
	 */
	function quickBar(){
		$s = "\n\t\t\t\t<ul>\n\t\t\t\t\t<li class=\"quickbarsections\">";

		$sep = "<br>\n\t\t\t\t\t";

		$s .= $this->menuHead( 'qbbrowse' ) . "\n\t\t\t\t\t";

		# Use the first heading from the Monobook sidebar as the "browse" section
		$bar = $this->getSkin()->buildSidebar();
		unset( $bar['SEARCH'] );
		unset( $bar['LANGUAGES'] );
		unset( $bar['TOOLBOX'] );

		$barnumber = 1;
		foreach ( $bar as $heading => $browseLinks ) {
			if ( $barnumber > 1 ) {
				$headingMsg = wfMessage( $heading );
				if ( $headingMsg->exists() ) {
					$h = $headingMsg->text();
				} else {
					$h = $heading;
				}
				$s .= "\n<h6>" . htmlspecialchars( $h ) . "</h6>";
			}
			if( is_array( $browseLinks ) ) {
				foreach ( $browseLinks as $link ) {
					if ( $link['text'] != '-' ) {
						$s .= "<a href=\"{$link['href']}\">" .
							htmlspecialchars( $link['text'] ) . '</a>' . $sep;
					}
				}
			}
			$barnumber++;
		}

		$user = $this->getSkin()->getUser();
		$s .= "</li>\n\t\t\t\t\t<li class=\"quickbarsections\">";
		if ( $this->data['isarticle'] ) {
			$s .= $this->menuHead( 'qbpageoptions' ) . "\n\t\t\t\t\t";
			$s .=  $this->printableLink();
			$s .= $sep . $this->historyLink();
			$s .= $sep . $this->editThisPage();

			if ( $user->isAllowed( 'delete' ) ) {
				$dtp = $this->deleteThisPage();
				if ( $dtp != '' ) {
					$s .= $sep . $dtp;
				}
			}
			if ( $user->isAllowed( 'protect' ) ) {
				$ptp = $this->protectThisPage();
				if ( $ptp != '' ) {
					$s .= $sep . $ptp;
				}
			}
		}
		$s .= "\n\t\t\t\t\t</li>\n\t\t\t\t</ul>";

		$s .= "\n\t\t\t</div>\n";
		return $s;
	}

	/**
	 * @param $key string
	 * @return string
	 */
	function menuHead( $key ) {
		$s = "\n<h6>" . wfMsg( $key ) . "</h6>";
		return $s;
	}

	/**
	 * @param $label string
	 * @return string
	 */
	function searchForm( $label = '' ) {
		global $wgUseTwoButtonsSearchForm;

		$search = $this->getSkin()->getRequest()->getText( 'search' );
		$action = $this->data['searchaction'];
		$s = "<form id=\"searchform{$this->searchboxes}\" method=\"get\" class=\"inline\" action=\"$action\">";
		if( $label != '' ) {
			$s .= "{$label}: ";
		}

		$s .= "<input type='text' id=\"searchInput{$this->searchboxes}\" class=\"mw-searchInput\" name=\"search\" size=\"20\" value=\""
			. htmlspecialchars( substr( $search, 0, 256 ) ) . "\" />";

		if( $wgUseTwoButtonsSearchForm ) {
			$s .= "<input type='submit' id=\"mw-searchButton{$this->searchboxes}\" class=\"searchButton\" name=\"fulltext\" value=\"" . htmlspecialchars( wfMsg( 'search' ) ) . "\" />\n";
		} else {
			$s .= '<div><a href="' . $action . '" rel="search">' . wfMsg( 'powersearch-legend' ) . "</a></div>\n";
		}

		$s .= '</form>';

		// Ensure unique id's for search boxes made after the first
		$this->searchboxes = $this->searchboxes == '' ? 2 : $this->searchboxes + 1;

		return $s;
	}
}
