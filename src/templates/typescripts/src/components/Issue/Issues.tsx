import * as React from "react";
import {IssueEntry} from "./IssueEntry";


export class Issues extends React.Component {
  render() {
    return(
      <div className="margin-bottom--xl">
        <h2>Results</h2>
        <IssueEntry/>
        <IssueEntry/>
        <IssueEntry/>
      </div>
    );
  }
}