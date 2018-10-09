import * as React from "react";
import Grid from "@material-ui/core/Grid";
import Button from "@material-ui/core/Button";
import Divider from "@material-ui/core/Divider";
import Typography from "@material-ui/core/Typography/Typography";

export class IssueEntry extends React.Component {
  render() {
    return(
      <div className="margin-bottom--xl">
        <Grid container spacing={24}>
          <Grid item sm={6}>
            <Button><i className="fa fa-clipboard"/></Button> SPK1032
          </Grid>
          <Grid item sm={6}>
            <Button><i className="fa fa-clipboard"/></Button>sdfdgdf
          </Grid>
        </Grid>
        <Grid container spacing={24}>
          <Grid item sm={1}>
            <Button><i className="fa fa-clipboard"/></Button>
          </Grid>
          <Grid item sm={11}>
            <Typography variant="body1" gutterBottom>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos blanditiis tenetur
              unde suscipit, quam beatae rerum inventore consectetur, neque doloribus, cupiditate numquam
              dignissimos laborum fugiat deleniti? Eum quasi quidem quibusdam.
            </Typography>
          </Grid>
        </Grid>
        <Divider/>
      </div>
    );
  }
}