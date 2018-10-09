import * as React from 'react';

/*
    ------ Usage --------
    const lifeCycleHooks = {
        componentDidMount: (ReactClass) => void,
        componentWillUnmount: (ReactClass) => void,
        etc.....
    }
    StateProvider(SomeComponent, someState, lifeCycleHooks);
*/

const StateProvider = (Component, initialState, lifeCycleHooks) =>
    class extends React.Component<any, void> {

        constructor(props) {
            super(props);
            this.state = initialState;

            const setLifeCycleEvents = fn =>
                this[fn] = (...args) => lifeCycleHooks[fn](this, ...args);

            Object.keys(lifeCycleHooks).forEach(setLifeCycleEvents);

            if (lifeCycleHooks._constructor) {
                lifeCycleHooks._constructor(this);
            }
        }

        displayName() {
            return Component.name;
        }

        render() {
            return Component({
                ...this.props,
                state: this.state,
                setState: (newState, callback) => this.setState(newState, callback),
                that: this,
            });
        }
    };

export default StateProvider;
