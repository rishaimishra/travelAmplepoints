@inject('siteData1', 'App\Http\Controllers\Site')
         @php   $data=json_decode($siteData1::Index(),true);
         		$pageData=json_decode($siteData1::PageData(),true);
			      
                  print_r($pageData);        
         @endphp
