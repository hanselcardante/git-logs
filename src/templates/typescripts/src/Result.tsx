import * as React from 'react';

interface Props {
    collectionItems: any;
}

export default class Result extends React.Component <Props, null>{

    render() {
      return (
        <div>
            <h2>SPK 3423</h2>
            <div>34h</div>
            <div>The quick brown fox</div>
        </div>
      )
    }
}
