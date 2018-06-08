// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class HelloWorld extends Component {

  static slug = 'mcdt_hello_world';

  render() {
  	
    const Content = this.props.content;

    return (
    	<Fragment>
	    	{ !! this.props.title && (
	    	  <h1>{this.props.title}</h1>
	    	) }
	        <Content/>
	    </Fragment>
    );
  }
}

export default HelloWorld;
