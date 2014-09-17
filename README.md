dental-affiliate-bootstrap is a theme built for ePractice Media. 

v0.1 - 06.25.2014
- Upload prototype to github
- Made smile gallery template using blue imp (to add images to lightbox you must but "data-gallery" and the end of their link)
- Comes with dynamic head, footer, pop-up contact form, blueimp photo/video gallery.
- Includes the following template files: (Full Width Template, Smile Gallery)
- Includes font awesome icons to use at your disposal

v0.2 - 07.25.2014
- Shortcode [icon-type=""] added. Ex: [icon type="google-plus-square"] displays a google plus icon
- Shortcode [listposts num="3" cat="1"] has been added. The shortcode displays the number of posts by its respective category.
- Theme options have been added along with dynamic content.
- Any wordpress gallery now opens its thumbnails in the blueimp lightbox.
- FitText.js, Retina.js added and can be used at your disposal. 
- Current issue where if shortcode is used on any child pages it takes away its page ID number. You can still style that page by 
  using .page-id as your class. 

Using Dynamic Content Generator:

1. Go to functions.php
2. See the example given in the theme. You use associative arrays to create seperated content.
3. To call the content into your theme simply place it into any .php file 
	Ex: <?php get_dyn_content("home", "title"); ?>

Creating a page with sections:
1. In WordPress create a Home page.
2. Create a seperate page in WordPress and make its parent the Home page.
3. To style the page you just created look up its page ID by viewing the source or using the web inspector tool.
4. You can see the page id in the body class Ex."page-id-23"
5. Go into your CSS file and simply called .page-id-23 and style how you would like. 