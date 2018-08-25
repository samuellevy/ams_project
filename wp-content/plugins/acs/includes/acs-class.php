<?php
/**
 * Adds Acs widget.
 */
 class Acs_Widget extends WP_Widget {
  
    /**
     * Register widget with WordPress.
     */
    function __construct() {
      parent::__construct(
        'acs_widget', // Base ID
        esc_html__( 'ACS', 'acs_domain' ), // Name
        array( 'description' => esc_html__( 'Widget to display ADS', 'acs_domain' ), ) // Args
      );
    }
  
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
      echo $args['before_widget']; // Whatever you want to display before widget (<div>, etc)

      if ( ! empty( $instance['title'] ) ) {
        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }
      
      // var_dump($this->getAds());
      // Widget Content Output
      // echo '<div class="g-ytsubscribe" data-channel="'.$instance['channel'].'" data-layout="'.$instance['layout'].'" data-count="'.$instance['count'].'"></div>';
      $count = (int)$instance['count'];
      echo "<div class='props'>";
      for($i=0;$i<$count;$i++){
        echo "<div class='props_item'>
          <img src='http://localhost/testt/img1.png' class=''/>
          <p>Jovens descobriram uma forma de ganhar dinheiro na Netshoes</p>
        </div>";
      }   
      echo "</div>";

      echo $args['after_widget']; // Whatever you want to display after widget (</div>, etc)
    }

    public function getAds(){
      $json = file_get_contents('http://localhost/testt/json.php');
      $obj = json_decode($json);
      return $obj;
    }
  
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
      $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title', 'acs_domain' );

      $token = ! empty( $instance['token'] ) ? $instance['token'] : esc_html__( 'Token', 'acs_domain' ); 
      
      $count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '1', 'acs_domain' ); 
      ?>
      
       <!-- TITLE -->
       <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
          <?php esc_attr_e( 'Title:', 'acs_domain' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $title ); ?>">
      </p>

      
      <!-- TOKEN -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
          <?php esc_attr_e( 'Token:', 'acs_domain' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'token' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'token' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $token ); ?>">
      </p>

      <!-- CHANNEL -->
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
          <?php esc_attr_e( 'count:', 'acs_domain' ); ?>
        </label> 

        <input 
          class="widefat" 
          id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" 
          name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" 
          type="text" 
          value="<?php echo esc_attr( $count ); ?>">
      </p>
      <?php 
    }
  
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      
      $instance['token'] = ( ! empty( $new_instance['token'] ) ) ? strip_tags( $new_instance['token'] ) : '';

      $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
  
      return $instance;
    }
  
  } // class Foo_Widget