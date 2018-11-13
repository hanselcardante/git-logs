import * as React from 'react';

const LogContext = React.createContext({});

export const LogProvider = LogContext.Provider;
export const LogConsumer = LogContext.Consumer;
