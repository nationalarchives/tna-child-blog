<?php

require dirname(__DIR__) . '/inc/functions-blog.php';
require dirname(__DIR__) . '/inc/functions-admin.php';

class blogFunctionsTest extends PHPUnit_Framework_TestCase
{
	public function testExample()
	{
		$this->assertTrue(true);
		$this->assertFalse(false);
	}
	public function test_exists_dequeue_parent_style()
	{
		$this->assertTrue(function_exists('dequeue_parent_style'));
	}
	public function test_exists_tna_child_styles()
	{
		$this->assertTrue(function_exists('tna_child_styles'));
	}
	public function test_exists_tna_child_scripts()
	{
		$this->assertTrue(function_exists('tna_child_scripts'));
	}
	public function test_exists_get_blog_image_caption()
	{
		$this->assertTrue(function_exists('get_blog_image_caption'));
	}
	public function test_exists_blog_sidebar_widgets()
	{
		$this->assertTrue(function_exists('blog_sidebar_widgets'));
	}
	public function test_exists_get_blog_authors()
	{
		$this->assertTrue(function_exists('get_blog_authors'));
	}
	public function test_exists_get_blog_list_authors()
	{
		$this->assertTrue(function_exists('get_blog_list_authors'));
	}
	public function test_exists_exclude_widget_categories()
	{
		$this->assertTrue(function_exists('exclude_widget_categories'));
	}
	public function test_exists_the_entry_meta()
	{
		$this->assertTrue(function_exists('the_entry_meta'));
	}
	public function test_exists_tna_blog_menu()
	{
		$this->assertTrue(function_exists('tna_blog_menu'));
	}
	public function test_exists_blog_admin_page_settings()
	{
		$this->assertTrue(function_exists('blog_admin_page_settings'));
	}
	public function test_exists_blog_admin_page()
	{
		$this->assertTrue(function_exists('blog_admin_page'));
	}
}
