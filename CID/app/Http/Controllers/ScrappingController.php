<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Goutte\Client;

class ScrappingController extends BaseController{
	//It's needed since href doesn't have it
	private $domain = "https://iclinic.com.br";
	private $current_chapter = "";
	private $current_group = "";
	private $current_categories = "";
	private $data = [];
	private $chapters = [];
	private $groups = [];
	private $categories = [];
	private $diseases = [];



	public function scrapping(){

		//Make this variable an attribute of the class
		$url = 'https://iclinic.com.br/cid/';
		$client = new Client();
		$crawler = $client->request('GET',$url);

		//Check if the url is a valid link before scrapping data
		$status_code = $client->getResponse()->getStatus();
		$this->data['chapters'] = [];
		if($status_code==200){
			// echo "<ul>";
		    $capitulos = $crawler->filterXPath('//*[@id="cid"]/div[1]/section[2]/div/div/a')
		    					 ->each(function(\Symfony\Component\DomCrawler\Crawler $node){
		    					 	$node_text = trim($node->text());
                    				$node_url = $node->attr('href');
                    				

                    				
                    				// Append node text and node_url to array on $data['groups']
                    				// echo"<li>".$node_text." : ".$node_url."</li>";
                    				// echo $node_text;
                    				// echo $node_url;
                    				$chapter = [];
                    				$chapter['groups'] = $this->scrapping_chapter($node_url);
                    				$chapter['value'] = $node_text;
                    				array_push($this->data['chapters'],$chapter);
		    					 });
		    // echo "</ul>";
		}
		
		$this->data['url'] = 'https://iclinic.com.br/cid/';
		return view('scrapping',$this->data);
	}

	//Comments are wrong
	// Receives a chapter's url then scrape its groups (and sections afterwards)
	public function scrapping_chapter($url){
		$this->groups = [];

		// Creating the chapter's full url
		$this->current_chapter = trim($this->domain.$url);

		$client = new Client();
		$crawler = $client->request('GET',$this->current_chapter);

		//Check if the url is a valid link before scrapping data
		$status_code = $client->getResponse()->getStatus();
		if($status_code==200){
			// echo "<ul>";
		    $capitulos = $crawler->filterXPath('//*[@id="cid"]/div[1]/section[2]/div/div/a')
		    					 ->each(function(\Symfony\Component\DomCrawler\Crawler $node){
		    					 	$node_text = trim($node->text());
                    				$node_url = $node->attr('href');
                    				// Append node text and node_url to array on $data['groups']
                    				// echo "string<br>";
                    				// echo "<li>".$node_text." : ".$node_url."</li>";
                    				
                    				$group = [];
                    				$group['value'] = $node_text;
                    				$group['categories'] = [];
                    				$group['categories'] = $this->scrapping_group($node_url);


                    				array_push($this->groups,$group);
		    					 });
		    // echo "</ul>";

		}
		return $this->groups;	
		
	}

	//Comments are wrong
	//Receives a group's url then scrape its categories
	public function scrapping_group($url){
		$this->categories = [];
		// Creating the chapter's full url
		$this->current_group = trim($this->domain.$url);

		$client = new Client();
		$crawler = $client->request('GET',$this->current_group);

		//Check if the url is a valid link before scrapping data
		$status_code = $client->getResponse()->getStatus();
		if($status_code==200){
			// echo "<ul>";
		    $capitulos = $crawler->filterXPath('//*[@id="cid"]/div[1]/section[2]/div/div/a')
		    					 ->each(function(\Symfony\Component\DomCrawler\Crawler $node){
		    					 	$node_text = trim($node->text());
                    				$node_url = $node->attr('href');
                    				// Append node text and node_url to array on $data['groups']
                    				// echo "string<br>";
                    				// echo "<li>".$node_text." : ".$node_url."</li>";
                    				
                    				$category = [];
                    				$category['value'] = $node_text;
                    				$category['diseases'] = $this->scrapping_categories($node_url);
                    				array_push($this->categories,$category);
                    				// 
		    					 });
		    // echo "</ul>";

		}
		return $this->categories;	
	} 

	//Comments are wrong
	//Receives a group's url then scrape its categories
	public function scrapping_categories($url){
		$this->diseases = [];
		// Creating the chapter's full url
		$this->current_categories = trim($this->domain.$url);

		$client = new Client();
		$crawler = $client->request('GET',$this->current_categories);

		//Check if the url is a valid link before scrapping data
		$status_code = $client->getResponse()->getStatus();
		if($status_code==200){
			// echo "<ul>";
		    $capitulos = $crawler->filterXPath('//*[@id="cid"]/div[1]/section[2]/div/div/h4')
		    					 ->each(function(\Symfony\Component\DomCrawler\Crawler $node){
		    					 	$node_text = trim($node->text());
                    				$node_url = $node->attr('href');
                    				// Append node text and node_url to array on $data['groups']
                    				// echo "string<br>";
                    				// echo "<li>".$node_text." : ".$node_url."</li>";
                    				
                    				$disease = [];
                    				$disease['value'] = $node_text;
                    				array_push($this->diseases,$disease);
		    					 });
		    // echo "</ul>";

		}
		return $this->diseases;	
	}


	
}//Class