<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="bs-callout bs-callout-warning hidden">
                <h4>Oh snap!</h4>
                <p>This form seems to be invalid :(</p>
            </div>

            <div class="bs-callout bs-callout-info hidden">
                <h4>Yay!</h4>
                <p>Everything seems to be ok :)</p>
            </div>

            <form id="demo-form" data-parsley-validate="">
                <label for="fullname">Full Name * :</label>
                <input type="text" class="form-control" name="fullname" required="">

                <label for="email">Email * :</label>
                <input type="email" class="form-control" name="email" data-parsley-trigger="change" required="">

                <label for="gender">Gender *:</label>
                <p>
                    M: <input type="radio" name="gender" id="genderM" value="M" required="">
                    F: <input type="radio" name="gender" id="genderF" value="F">
                </p>

                <label for="hobbies">Hobbies (Optional, but 2 minimum):</label>
                <p>
                    Skiing <input type="checkbox" name="hobbies[]" id="hobby1" value="ski"
                                  data-parsley-mincheck="2"><br>
                    Running <input type="checkbox" name="hobbies[]" id="hobby2" value="run"><br>
                    Eating <input type="checkbox" name="hobbies[]" id="hobby3" value="eat"><br>
                    Sleeping <input type="checkbox" name="hobbies[]" id="hobby4" value="sleep"><br>
                    Reading <input type="checkbox" name="hobbies[]" id="hobby5" value="read"><br>
                    Coding <input type="checkbox" name="hobbies[]" id="hobby6" value="code"><br>
                </p>

                <p>
                    <label for="heard">Heard about us via *:</label>
                    <select id="heard" required="">
                        <option value="">Choose..</option>
                        <option value="press">Press</option>
                        <option value="net">Internet</option>
                        <option value="mouth">Word of mouth</option>
                        <option value="other">Other..</option>
                    </select>
                </p>

                <p>
                    <label for="message">Message (20 chars min, 100 max) :</label>
                    <textarea id="message" class="form-control" name="message" data-parsley-trigger="keyup"
                              data-parsley-minlength="20" data-parsley-maxlength="100"
                              data-parsley-minlength-message="Come on! You need to enter at least a 20 character comment.."
                              data-parsley-validation-threshold="10"></textarea>
                </p>

                <br>
                <input type="submit" class="btn btn-default" value="validate">

                <p>
                    <small>* Please, note that this demo form is not a perfect example of UX-awareness. The aim here is
                        to show
                        a
                        quick overview of parsley-API and Parsley customizable behavior.
                    </small>
                </p>
            </form>
        </div>
    </div>

<?php $__env->startSection('scripts'); ?>

    <script type="text/javascript">
        $(function () {
            $('#demo-form').parsley().on('field:validated', function () {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
                    .on('form:submit', function () {
                        return false; // Don't submit form for this demo
                    });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>