// External Dependencies
import React, { Component, Fragment } from 'react';
import CompareTabItem from '../CompareTabItem/CompareTabItem';

// Internal Dependencies
import './style.css';


class CompareTab extends Component {

  static slug = 'mcdt_compare_tab';

  /*componentWillUpdate(nextProps, nextStates) {
    console.log('parent will update')
    console.log(nextProps.show_option, this.props.show_option);
    //if( nextProps.show_option !== this.props.show_option ) {
      this.props.content.forEach(elem => { 
         elem.props.attrs.itemShowOption  = nextProps.show_option;
         console.log('elem from parent', elem);
      } )
    //}
  }

  componentDidUpdate(prevProps, prevStates) {
     console.log('parent did update')
     this.props.content.forEach(elem => { 
        elem.props.attrs.itemShowOption  = this.props.show_option;
        console.log('elem from parent', elem);
     } )
  }*/

  render() {

    console.log('parent', this);
    return (
      <Fragment>
        <h2 className="dicm-title">{this.props.title}</h2>
        <div className="dicm-content">
          <CompareTabItem content={ this.props.content } itemShowOption={this.props.show_option} />
        </div>
      </Fragment>
    );
  }
}

export default CompareTab;
