<?php

/**
 * IRLContentType class,
 * makes it easier to create custom post types in WordPress
 * for yout themes, plugins, etc.
 *
 */

class IRLContentType{

  public $name;

  public $plural = "types";

  public $singular = "type";

  public $labels = array();

  public $supports = array( 'title', 'editor', 'thumbnail', 'comments' );

  public function __construct(){

    // hook the init methd to the init action
    add_action( 'init', array( $this, 'init' ) );
  }

  public function init(){
    $this->register_post_type();
    $this->register_taxonomies();
  }

  public function register_post_type(){
    // inits a pretty well-guessed labels default array
    $singular = $this->singular;
    $plural   = $this->plural;

    if ( ! $this->name ) {
    	$this->name = sanitize_title_with_dashes( $plural );
    }

    // this configs the labels.
    $labels = array(
      'name'          => $plural,
      'singular_name' => $singular,
      'add_new'       => sprintf( __( 'Add New %s', 'irl' ),$singular ),
      'add_new_item'  => sprintf( __( 'Add New %s', 'irl' ), $singular ),
      'edit_item'     => sprintf( __( 'Edit %s', 'irl' ), $singular ),
      'new_item'      => sprintf( __( 'New %s', 'irl' ), $singular ),
      'view_item'     => sprintf( __( 'View %s', 'irl' ), $singular ),
      'search_item'   => sprintf( __( 'Search %s', 'irl' ), $singular ),
    );

    $this->labels = $this->set_post_type_labels( $labels );

    $options = array(
      'public'        => true,
      'show_ui'       => true,
      'label'         => ucfirst($this->plural),
      'id'            => 'menu-' . $this->plural,
      'labels'        => $this->labels,
      'supports'      => $this->supports,
      'hierarchical'  => false,
      'has_archive'   => true,
    );

    // register the post type.
    register_post_type( $this->name, $this->set_post_type_options( $options ) );

  }

  public function set_post_type_labels( $defaults ){
    return $defaults;
  }

  public function set_post_type_options( $defaults ){
    return $defaults;
  }

  public function register_taxonomies(){
    return;
  }

}
