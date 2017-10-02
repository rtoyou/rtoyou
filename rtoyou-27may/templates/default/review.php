<?php
/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 1/10/16
 * Time: 8:01 PM
 */

$reviewTemplate = '<div class="panel panel-default">
	<div class="panel-body">
		<div class="media media-clearfix-xs media-clearfix-sm">
			<div class="media-left">
				<p>
					<a href="javascript:void(0);"> <img
						src="{{userPic}}"
						alt="{{reviewer}}" width=100 height=100 class="media-object  img-circle user-pic">
					</a>
				</p>
				<div class="text-center small">
					<div class="">{{reviewer}}</div>
					{{{starHtml}}}
				</div>
			</div>
			<div class="media-body">
				<h4 class="media-heading margin-v-0-10">
					<a href="javascript:void(0);">{{title}}</a> <small
						class="text-grey-400"><i class="fa fa-clock-o fa-fw" title="{{created}}"></i> {{time}}</small>
				</h4>

				<div class="expandable expandable-trigger {{^indicator}} indicator-false {{/indicator}} ">
					<div class="expandable-content">
						{{review}}
						{{#indicator}}
						<div class="expandable-indicator">
							<i></i>
						</div>
						{{/indicator}}
					</div>
				</div>
				{{#images}}
				<div id="review-images">
				<ul>
				        {{#img1}}
						<li><a
							href="{{images.img1.url}}"
							data-imagelightbox="e"><img
								src="{{images.img1.url}}"
								alt="{{images.img1.title}}" /> </a></li>
					    {{/img1}}
					    
					    {{#img2}}
						<li><a
							href="{{images.img2.url}}"
							data-imagelightbox="e"><img
								src="{{images.img2.url}}"
								alt="{{images.img2.title}}" /> </a></li>
						{{/img2}}
						
						{{#img3}}
						<li><a
							href="{{images.img3.url}}"
							data-imagelightbox="e"><img
								src="{{images.img3.url}}"
								alt="{{images.img3.title}}" /> </a></li>
						{{/img3}}
						
						{{#img4}}
						<li><a
							href="{{images.img4.url}}"
							data-imagelightbox="e"><img
								src="{{images.img4.url}}"
								alt="{{images.img4.title}}" /> </a></li>
						{{/img4}}
						
						{{#img5}}
						<li><a
							href="{{images.img5.url}}"
							data-imagelightbox="e"><img
								src="{{images.img5.url}}"
								alt="{{images.img5.title}}" /> </a></li>
						{{/img5}}
						
					</ul>
				</div>
				{{/images}}
			</div>
		
			<div class="equal-padding" style="margin-top: 4px;">

				<button
					class="btn btn-xs btn-danger pull-right bad ladda-button"
					data-value="{{review_id}}" data-style="expand-left"
					style="margin-right: 4px;">
					<i class="fa fa-thumbs-down"></i> Bad (<Span
						class="b_{{review_id}}_count">{{bad}}</Span>){{#bad_sel}}<i class="fa fa-check"></i>{{/bad_sel}}
				</button>
				&nbsp;
				<button
					class="btn btn-xs btn-default pull-right cool ladda-button"
					data-value="{{review_id}}" data-style="expand-left"
					style="margin-right: 4px;">
					<i class="icon-cool"></i> Cool (<Span class="c_{{review_id}}_count">{{cool}}</Span>){{#cool_sel}}<i class="fa fa-check"></i>{{/cool_sel}}
				</button>
				&nbsp;
				<button
					class="btn btn-xs btn-success pull-right awesome ladda-button"
					data-value="{{review_id}}" data-style="expand-left"
					style="margin-right: 4px;">
					<i class="fa fa-thumbs-up"></i> Awesome (<Span
						class="a_{{review_id}}_count">{{awesome}}</Span>){{#awesome_sel}}<i class="fa fa-check"></i>{{/awesome_sel}}
				</button>
				&nbsp;
			</div>
		</div>
	</div>

	</div>';

?>

<script type="x-tmpl-mustache" id="reviewTpl">

    <?php echo $reviewTemplate;?>

</script>
