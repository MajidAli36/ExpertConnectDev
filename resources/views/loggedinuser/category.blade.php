@extends('loggedinuser.app')
@push('styles')
<link rel="stylesheet" href="{{url('css/dashboard.css')}}" type="text/css" />
<link rel="stylesheet" href="{{url('css/videolibrary.css')}}" type="text/css" />
<link rel="stylesheet" href="{{url('css/category.css')}}" type="text/css" />
@endpush
@push('scripts')
<script type="text/javascript">
	// $(document).ready(function(){
	//   	e.preventDefault();
	//   	var a = $(this).attr("data-video");
	//   	var b = $(this).next();
	//   	$(".video-show").insertAfter(b);
	//   	$(".video-show video").attr("src", a);
	// 		$(".video-show").slideToggle();
	// 		$(".video-show video").get(0).play();
	// 	});
	// });
</script>
@endpush
@section('content')
<?php
$category=str_replace("_"," ", trim($category));
$filterData=array();
$categoryList=array();
$dataArray=$data->data->video_data;
$freevideos=$FreeSamples;
foreach ($dataArray as $i=>$mainMenu) {
	if($i!=2){
		foreach ($mainMenu as $subMenu){
			if ($subMenu->subMenuItem==NULL) {
				if(strcmp(trim($subMenu->menuHeading),$category)==0){
					$filterData=$subMenu;
				}
			}else{
				if(strcmp(trim($subMenu->menuHeading),$category)==0){
					$filterData=$subMenu->subMenuItem;
					// 	 $('.video-cat .img-div').click(function (e) {
				}
			}
				array_push($categoryList , trim($subMenu->menuHeading));
		}
	}
		else{
			// $filterData=$mainMenu;
			foreach ($mainMenu as $mitem) {
				array_push($categoryList , trim($mitem->menuHeading));
				if(strcmp(trim($mitem->menuHeading),$category)==0){
					array_push($filterData,$mitem);
					// echo "<pre>";print_r($filterData);die;
				}
			}
		}

}
// print_r($filterData);die;
?>
<div class="wrapper">
<div class="video-pop videolib-pop simplePopup">
	<video src="{{ url('/homepage/images/hero.mp4') }}" loop controls controlsList="nodownload"></video>
</div>
<div class="content">
	<div class="inner">
		<div class="browse video-cat" id="browse">
			<h1> <a href="{{ url('/videolibrary')}}" style="color: #fff;"> Video library </a></h1>
			<div class="cat-filter">
			<?php //print_r($categoryList);
			?>
			<select id="custom_changeCat">
				<!-- <option value="">Categories</option> -->
					<?php
					$selected=("Free Instructional Videos"==$category)?"selected":"";
					echo '<option value="Free Instructional Videos" '.$selected.'>Free Instructional Videos</option>';
					foreach ($categoryList as $clist) {
						$selected=($clist==$category)?"selected":"";
						echo '<option value="'.$clist.'" '.$selected.'>'.$clist.'</option>';
					}
				?>
				</select>
			</div>
			@if ("Free Instructional Videos"==$category)
			<div class="tab-div">
				<div class="tab-data">
					<h2 class="title">Free Instructional Videos</h2>
					<ul class="be-select-tab">
						<li class="clickme active" id="custom_showalltab"><a class="filter" data-tag="outer_all_1">All Videos</a></li>
					</ul>
					<div class="tab-container">
						<div class="list list-all show-tab" id="outer_all_1">
							<div class="video-cat-list">
								<ul id="column">
									@foreach ($freevideos as $i=>$videos)
													<li slide-data="inner_all_{{$i}}">
															<div class="img-div">
																	<img src="<?php echo ($videos->webThumbnail==NULL)?"https://s3.amazonaws.com/expertconnectvideothumbnails/Julian+Talks+Tennis+PartOneSQ.jpg":$videos->webThumbnail; ?>" alt="Tim Mayotte">
																<div class="video-btn"></div>
															</div>
													</li>
										@endforeach
									</ul>
									<div id="columns" class="video-cat-list"></div>
									<div id="video-detail-drop">
										@foreach ($freevideos as $i=>$videos)
											<div slide-data="inner_all_{{$i}}" class="videolib-detail">
													<div class="close-lib-btn"></div>
													<div class="banner dashboard-bg" style="background-image: url(<?php echo ($videos->webBanner==NULL)?'https://s3.amazonaws.com/expertconnectvideothumbnails/Julian+Talks+Tennis+PartOneSQ.jpg':$videos->webBanner; ?>">
													</div>
													<div class="video-lib-detail" id="free_sample" data-video="<?php echo ($videos->videoURL==NULL)?"https://s3.amazonaws.com/expertconnectvideos/Julian+Talks+Tennis.mp4":$videos->videoURL; ?>"></div>
												</div>
											@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@else	<div class="tab-div">
				<div class="tab-data">
			 		<h2 class="title">{{ $category }}</h2>
			   	<ul class="be-select-tab">
			      <li class="clickme active" id="custom_showalltab"><a class="filter" data-tag="outer_all_1">All Videos</a></li>
			   		<?php
			   		if(!empty($filterData))
			   		{
				   		foreach ($filterData as $i=>$value) {
				   			if($value->menuLevel==2)
				   			echo '<li class="clickme"><a class="filter" data-tag="outer_'.$i.'">'.$value->menuHeading.'</a></li>';
						}
					}
			   		?>
			    </ul>
			    <div class="tab-container">
						<div class="list list-all show-tab" id="outer_all_1">
							<div class="video-cat-list">
								<ul id="column">
									@foreach ($filterData as $i=>$value)
								    	@foreach ($value->endDisplayItem as $j=>$videos)
								      		<li slide-data="inner_all_{{$i}}_{{$j}}">
															<div class="img-div">
																	<img src="<?php echo ($videos->webThumbnail==NULL)?"https://s3.amazonaws.com/expertconnectvideothumbnails/Julian+Talks+Tennis+PartOneSQ.jpg":$videos->webThumbnail; ?>" alt="Tim Mayotte">
							    								<!-- <strong>{{$videos->menuHeading}}</strong> -->
							    							<div class="video-btn"></div>
															</div>
													</li>
											@endforeach
										@endforeach
									</ul>
									<div id="columns" class="video-cat-list"></div>
									<div id="video-detail-drop">
										@foreach ($filterData as $i=>$value)
									    @foreach ($value->endDisplayItem as $j=>$videos)
												<div slide-data="inner_all_{{$i}}_{{$j}}" class="videolib-detail">
													<div class="close-lib-btn"></div>
													<div class="banner dashboard-bg" style="background-image: url(<?php echo ($videos->webBanner==NULL)?'https://s3.amazonaws.com/expertconnectvideothumbnails/Julian+Talks+Tennis+PartOneSQ.jpg':$videos->webBanner; ?>">
														<!-- <div class="dashboard-banner">
																									        <div class="dashboard-banner-text">
																										        <h2>{{$videos->menuHeading}}</h2>
																										        <p>{{$videos->menuDescription}}</p>
																									        </div>
																									     	</div> -->
													</div>
													<div class="video-lib-detail" data-video="<?php echo ($videos->videoURL==NULL)?"https://s3.amazonaws.com/expertconnectvideos/Julian+Talks+Tennis.mp4":$videos->videoURL; ?>"></div>
												</div>
												@endforeach
											@endforeach
									</div>
								</div>
				    	</div>
						<?php
			   		foreach ($filterData as $i=>$value) {
			   		?>
			      <div class="list" id="outer_{{ $i }}">
							<div class="video-cat-list">
								<ul id="column">
							      	<?php
							      	 foreach ($value->endDisplayItem as $j=>$videos) {
						      	 	?>
									<li slide-data="inner_{{$i}}_{{$j}}">
										<div class="img-div">
											<img src="<?php echo ($videos->webThumbnail==NULL)?"https://s3.amazonaws.com/expertconnectvideothumbnails/Julian+Talks+Tennis+PartOneSQ.jpg":$videos->webThumbnail; ?>" alt="Tim Mayotte">
					    				<!-- <strong>{{$videos->menuHeading}}</strong> -->
					    				<div class="video-btn"></div>
										</div>
									</li>
									<?php
										}
									 ?>
								</ul>
								<div id="columns" class="video-cat-list"></div>
								<div id="video-detail-drop">
									<?php
							      	 foreach ($value->endDisplayItem as $j=>$videos) {
						      	 	?>
									<div slide-data="inner_{{$i}}_{{$j}}" class="videolib-detail">
										<div class="close-lib-btn"></div>
										<div class="banner dashboard-bg" style="background-image: url(<?php echo ($videos->webBanner==NULL)?'https://s3.amazonaws.com/expertconnectvideothumbnails/Julian+Talks+Tennis+PartOneSQ.jpg':$videos->webBanner; ?>">
										</div>
										<div class="video-lib-detail" data-video="<?php echo ($videos->videoURL==NULL)?"https://s3.amazonaws.com/expertconnectvideos/Julian+Talks+Tennis.mp4":$videos->videoURL; ?>"></div>
									</div>
									<?php
									}
									?>
								</div>
							</div>
			    	</div>
			    	<?php
		    		}
			    	?>
			    	</div>
			  	</div>
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
{{-- <input type="hidden" id="redirectUrl" value=""> --}}
@endsection

@push('scripts')
<script type="text/javascript">
	// $("#custom_showalltab").click(function(){
	// 	$(".list").each(function(){
	// 		$(this).addClass('show-tab');
	// 	});
	// });

	$("#custom_changeCat").change(function(){
			var cat = $(this).val();
			cat=cat.replace(" ","_")
			window.location.href="category?category="+cat;
	});

	$("document").ready(function(){
		$('body').addClass('category-page');
		$(".video-lib-detail").click(function(){
			if ($(this).attr("id") == "free_sample"){
				var a = $(this).attr("data-video");
				$(".video-pop video").attr("src", a);
				$(".video-pop").simplePopup();
				$(".video-pop video").get(0).play();
			} else{
				@if (Session::get('userId') == null)
					window.location = 'login';
				@else
				var a = $(this).attr("data-video");
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		    $.ajax({
		            url: '/subscription',
		            type: 'POST',
		            data: {_token: CSRF_TOKEN, "message":"hello"},
		            dataType: 'JSON',
		            success: function (data) {
		                if(data)
		                {
		                	window.location.href = '/subscription';
		                }else{
		                	$(".video-pop video").attr("src", a);
			                 $(".video-pop").simplePopup();
			                 $(".video-pop video").get(0).play();
		                }
		            }
		        });
				@endif
			}
	    });
	});

</script>
@endpush
