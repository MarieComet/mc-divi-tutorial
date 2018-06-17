// External Dependencies
import React, { Component, Fragment } from 'react';

// Internal Dependencies
import './style.css';


class CompareTabItem extends Component {

  static slug = 'mcdt_compare_tab_item';

  render() {

    const getHTML = content => {
        return {__html: content }
    }

    return(
     <Fragment>
      { this.props.content.map( elem => {

        return (
          <div className="et_pb_module_inner">
          <h2 className="dicm-title-sub-title"> { elem.props.attrs.title }</h2>
          { ( this.props.itemShowOption && this.props.itemShowOption === 'on' ) && (
            <div className="dicm-content-subcontent" dangerouslySetInnerHTML={ getHTML( elem.props.content ) }></div>
          ) }
          </div>
        )
      } ) }
      </Fragment>
    )
  }
}

export default CompareTabItem;
