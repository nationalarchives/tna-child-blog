# tna-child-blog

Child theme for TNA's blog.

## Blog dashboard security

### IP whitelist

Blog dashboard is restricted to whitelisted IP addresses. To add a new IP address: 

WP dashboard -> Settings -> TNA AWS -> Whitelist

Note: IP addresses must be comma separated.

## Blog Configuration

### Date format

WP dashboard -> Settings -> General -> Date Format -> Custom = 'D j M Y'

### Header image

WP dashboard -> Blog settings -> Blog header

Add image URL and caption

### Front page displays - A static page

WP dashboard -> Settings -> Reading

#### Front page

Set 'Front page' to the page 'Blog'

#### Posts page

Set 'Posts page' to the page 'Blogposts'

WP dashboard -> Blog settings -> All posts

Add URL for 'View all posts' button on home page

### Homepage template

Edit 'Blog' page and change template to 'Blog home'

### Co-authors

Add [Co-Authors Plus plugin](https://en-gb.wordpress.org/plugins/co-authors-plus/)

### Widgets

WP dashboard -> Appearance -> Widgets

#### Homepage widgets

Add Recent Comments and Tag Cloud widgets

#### Sidebar widgets

Add Recent Posts, Recent Comments, Categories, Tag Cloud and Links widgets

## AMP Configuration

### Change blog type

WP dashboard -> Blog settings -> Blog type

Select 'Archives Media Player'

### Header image

WP dashboard -> Blog settings -> Blog header

Add image URL and caption

### Front page displays - A static page

Create a new page named 'Home'

Change template to 'AMP home'

Create a new page named 'All posts'

WP dashboard -> Settings -> Reading

#### Front page

Set 'Front page' to the page 'Home'

#### Posts page

Set 'Posts page' to the page 'All posts'

WP dashboard -> Blog settings -> All posts

Add 'All posts' URL to 'View all posts' button on home page

### Co-authors

If not installed and enabled: [Co-Authors Plus plugin](https://en-gb.wordpress.org/plugins/co-authors-plus/)

### Widgets

WP dashboard -> Appearance -> Widgets

#### Homepage widgets

Add Recent Comments and Tag Cloud widgets

#### Sidebar widgets

Add Recent Comments, Tag Cloud, Help and Subscribe widgets

## GitHub Actions

GitHub Actions can be used to deploy this theme to the dev, staging, nad live environments of the blog and media sites 