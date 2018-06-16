// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class CompareTabItem extends Component {

  static slug = 'mcdt_compare_tab_item';

  /*componentWillMount() {
    this.setState( { itemShowOption: 'off' } )
  }*/

  render() {

    console.log(this);

    return (
      <div>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">{this.props.content()}</div>
      </div>
    );
  }
}

export default CompareTabItem;
