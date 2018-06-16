// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class CompareTab extends Component {

  static slug = 'mcdt_compare_tab';

  componentWillMount() {
    //this.setState( { showOption: this.props.show_option } )
  }

  render() {

    console.log(this);

    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content}</div>
      </div>
    );
  }

  /*componentDidUpdate(lastProps, lastStates) {

    if( lastProps.show_option !== this.props.show_option ) {
      const showOption = this.props.content.map( ( content ) =>
        //console.log(content)
        this.setState( { itemShowOption: this.props.show_option } )
      );
    }
    //console.log(lastProps, this.props);
  }*/
}

export default CompareTab;
