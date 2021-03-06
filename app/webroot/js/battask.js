$(function(){
    $.extend({Battask:{}});

    $.Battask.initialize = function()
    {
        $('.entry-row').removeClass('active');
        $.Battask.observeEntryRow();
        $.Battask.getDayEntries();

    };

    $.Battask.observeEntryRow = function()
    {
        // Input Observers
        $('.entry-row input, .entry-row textarea').focus(function(){
            $(this).parents('.entry-row').addClass('active');
        }).blur(function(){
            $(this).parents('.entry-row').removeClass('active');
            $.Battask.processEntryRow($(this).parents('.entry-row'));
        });

        // Ajax update on input blur
        $('.entry-row :input').blur(function(evt){
            var $parent = $(this).parents('.entry-row');
            var data = $parent.find(':input').serializeArray();
            data.push($('#Day').serializeArray()[0]);
            $.ajax({
                type: 'post',
                url: '/entries/ajaxUpdateAll',
                dataType: 'json',
                data: data,
                success: function(data){
                    //Set id of new entry if a new one was created
                    if(data) {
                        $parent.find('input.id').val(data['id']);
                        $.Battask.addEntryTemplate();
                    }
                },
                error: function(data){
                    alert('Update failed. CONTACT SUPPORT!')
                }
            });
        });

        // Task Id Observes
        $('.attask-id input[type=text]').focus(function(){
            $.Battask.altTaskFlyout($(this), 'show');
        }).blur(function(){
            $.Battask.altTaskFlyout($(this), 'hide');
        });

        // Task Id Flyout Children Event Observer

        $('.alt-tasks a').mousedown(function(evt){
            $.Battask.updateAttaskInputs($(evt.target));
        });

    };

    $.Battask.processEntryRow = function(currentRow)
    {
        currentRow.each(function(){
            $.Battask.updateDecimals($(this));
        });
        $.Battask.calculateTotalTime();
    };

    $.Battask.updateDecimals = function(currentRow)
    {
        var startTime = currentRow.find('.start-time input');
        var endTime = currentRow.find('.end-time input');
        var decTime = currentRow.find('.decimal-time');
        if(startTime.val() !== '' && endTime.val() !== ''){
            decTime.html($.Battask.calculateTime(startTime.val(), endTime.val()));
        }
    };

    $.Battask.calculateTime = function(startTime, endTime){
        var convertToSecondsBase, convertToSecondsExtra, compareTimes, firstTime, secondTime, finalTime;
        convertToSecondsBase = function(time)
        {
            var splitTime = time.split(/\D+/);
            return (splitTime[0] * 60 * 60) + (splitTime[1] * 60);
        };

        convertToSecondsExtra = function(time)
        {
            var splitTime = time.split(/\D+/);
            //console.log(Math.floor(splitTime[0])+12);
            return ((Math.floor(splitTime[0])+12) * 60 * 60) + (splitTime[1] * 60);
        };

        compareTimes = function(firstTime, secondTime)
        {
            var bool;
            var firstTime = convertToSecondsBase(firstTime);
            var secondTime = convertToSecondsBase(secondTime);
            if(firstTime < secondTime){
                bool = true;
            }else{
                bool = false;
            }
            return bool;
        };

        firstTime = convertToSecondsBase(startTime);

        if(compareTimes(startTime,endTime)){
            secondTime = convertToSecondsBase(endTime);
            finalTime = ((((secondTime - firstTime)/60)/60)).toFixed(2);
        }else{
            secondTime = convertToSecondsExtra(endTime);
            finalTime = ((((secondTime - firstTime)/60)/60)).toFixed(2);
        }

        return finalTime;
    };

    $.Battask.calculateTotalTime = function(){
        var currentDate, rowTotals, currentTotal, currentDateTotal, hourType;

        currentDate = $('.current');
        rowTotals = $('.current').find('.list .decimal-time');
        runningTotal = 0;
        currentTotal = rowTotals.each(function(){
            runningTotal = ($(this).html() * 1) + runningTotal;
        });
        currentDateTotal = $('.current .time-totals').find('h2');
        if(runningTotal < 1 || runningTotal > 1){
            hourType = 'hours';
        }else{
            hourType = 'hour';
        }
        currentDateTotal.html((runningTotal).toFixed(2) + ' ' + hourType);
    };

    //Ajax Rendering
    $.Battask.getDayEntries = function(date)
    {
        var data = [];
        if (date) {
            data.push({name:'date', value:date});
        }
        $.ajax({
            type: 'post',
            url: '/entries/ajaxDayEntries',
            data: data,
            success: function(data){
                $('#TodayEntries').html(data);
                $.Battask.processEntryRow($('.entry-row'));
                $.Battask.observeEntryRow();
                $.Battask.populateTaskList();
            }
        });
    };

    $.Battask.populateTaskList = function()
    {

    }

    $.Battask.altTaskFlyout = function(currentInput, state)
    {
        // Show or Hide Flyout
        if(state == 'show'){
            currentInput.parents('.attask-id').addClass('show');
        }else{
            currentInput.parents('.attask-id').removeClass('show');
        }

    }

    $.Battask.updateAttaskInputs = function(selectedType)
    {
        var taskType, fieldValue, hiddenValue, hiddenInput, inputField;

        taskType = selectedType.parents('li').attr('class');
        inputField = selectedType.parents('.attask').find('input[type=text]');

        switch(taskType)
        {
            case 'general-overhead':
                fieldValue  = 'GO';
                break;
            case 'lunch':
                fieldValue = 'Lunch';
                break;
            case 'ooo':
                fieldValue = 'OOO';
                break;
            case 'vacation':
                fieldValue = 'Vacation';
                break;
        }

        inputField.val(fieldValue);

    };

    $.Battask.addEntryTemplate = function()
    {
        $.ajax({
            url: '/entries/ajaxGetEntryTemplate',
            success: function(data){
                $('#TodayEntries').append(data);
            }
        });
    };


    //Observer for date picker
    $('#DatePicker .dropdown li.date').click(function(){
        $.Battask.getDayEntries($(this).text());
    });

    $(window).load(function(){
        $.Battask.initialize();
    });

});