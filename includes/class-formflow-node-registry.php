<?php
/**
 * Registry for discovering and managing all FormFlow Nodes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FormFlow_Node_Registry {

    /**
     * @var FormFlow_Node[] Map of node_id => node instance
     */
    private $nodes = array();

    public function __construct() {
        $this->load_abstract();
        $this->discover_nodes();
    }

    /**
     * Load the abstract base class required for all nodes
     */
    private function load_abstract() {
        require_once FORMFLOW_PLUGIN_DIR . 'includes/nodes/abstract-class-formflow-node.php';
    }

    /**
     * Scan the nodes directory and load all node classes
     */
    private function discover_nodes() {
        $categories = array('input', 'trigger', 'validation', 'spam', 'action');
        
        foreach ( $categories as $category ) {
            $nodes_dir = FORMFLOW_PLUGIN_DIR . 'includes/nodes/' . $category . '/';
            
            if ( ! is_dir( $nodes_dir ) ) {
                continue;
            }

            $files = glob( $nodes_dir . 'class-node-*.php' );
            
            if ( ! $files ) {
                continue;
            }

            foreach ( $files as $file ) {
                require_once $file;
                
                // Extract class name from filename: class-node-text-field.php -> FormFlow_Node_Text_Field
                $basename = basename( $file, '.php' );
                $class_name = 'FormFlow_' . str_replace( '-', '_', ucwords( substr( $basename, 6 ), '-' ) );

                if ( class_exists( $class_name ) ) {
                    $node_instance = new $class_name();
                    if ( $node_instance instanceof FormFlow_Node ) {
                        $this->register_node( $node_instance );
                    }
                }
            }
        }
    }

    /**
     * Register a single node instance
     *
     * @param FormFlow_Node $node
     */
    public function register_node( FormFlow_Node $node ) {
        $this->nodes[ $node->get_id() ] = $node;
    }

    /**
     * Get all registered nodes
     *
     * @return FormFlow_Node[]
     */
    public function get_all_nodes() {
        return $this->nodes;
    }

    /**
     * Get all nodes as an array of JSON-serializable configurations for the frontend
     *
     * @return array
     */
    public function get_frontend_nodes() {
        $frontend_nodes = array();
        
        foreach ( $this->nodes as $id => $node ) {
            $frontend_nodes[ $id ] = $node->to_array();
        }

        return $frontend_nodes;
    }
}
