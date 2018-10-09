import * as React from "react";
import withStyles from "@material-ui/core/styles/withStyles";
import Grid from "@material-ui/core/Grid";
import FormHeader from "./FormHeader";
import TextField from "@material-ui/core/TextField";
import Button from "@material-ui/core/Button";

const styles = theme => ({
  buttons: {
    display: "flex",
    justifyContent: "flex-end",
  },
  button: {
    marginTop: theme.spacing.unit * 3,
    marginLeft: theme.spacing.unit,
  }
});

class MainForm extends React.Component {
  render() {

    // @ts-ignore
    const { classes } = this.props;

    return (

      <React.Fragment>
          <Grid container spacing={24}>
              <Grid item xs={12} sm={12}>
                <FormHeader />
              </Grid>
          </Grid>
      </React.Fragment>
    );
  }
}

export default withStyles(styles)(MainForm);