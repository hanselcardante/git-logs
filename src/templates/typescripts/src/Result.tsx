import * as React from 'react';
import * as _ from 'lodash/fp';
import {LogConsumer} from './LogContext';
import {copyToClipboard} from './Helpers';

const CopyButton = (text: any) => <button onClick={e => copyToClipboard(text)}>Copy to Clipboard</button>;

const Items = (context: any) => {
   const item = Object.keys(context).map(k => {
        return (
            <div>
               <h2>{context[k].ticketNumber} {CopyButton(context[k].ticketNumber)}</h2>
                <div>{context[k].hoursWorked} {CopyButton(context[k].hoursWorked)}</div>
                <div>{context[k].commitMessages.join(', ')} {CopyButton(context[k].commitMessages.join(', '))}</div>
                <hr />
           </div>
        )
    });

    return (
        <div>
            {item}
        </div>
    );
}

export const Result = () => {
    return (
        <LogConsumer>
        { context => Items(context) }
        </LogConsumer>
    )
}
