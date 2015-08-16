<?php

class GetRSS {
	private $xml;
	private $res;

	function LoadRSS($url) {
		$xml = @simplexml_load_file($url);
		$res=NULL;
#
# Is RSS?
#
		if ($xml->channel->item) {
			foreach($xml->channel->item as $item) {
				$pubDate=date('Y-m-d H:i:s', strtotime($item->pubDate));
				$this->res[] = array( 'url' => (string)$item->link, 'title' => (string)$item->title, 'pubDate' => $pubDate, 'description' => (string)$item->description );
			}
		}
#
# Is ATOM?
#
		if ($xml->item) {
			$namespaces = $xml->getNameSpaces(true);
			foreach($xml->item as $item) {
				$namespaces = $item->getNameSpaces(true);
				$dc = $item->children($namespaces['dc']);
				$pubDate=date('Y-m-d H:i:s', strtotime($dc->date));
				$this->res[] = array( 'url' => (string)$item->link, 'title' => (string)$item->title, 'pubDate' => $pubDate, 'description' => (string)$item->description );
			}
		}
	}

	function GetALL() {
		return $this->res;
	}
}

?>
