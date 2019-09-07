import SpaceX from '../javascript/spaceX';


describe('SpaceX', function () {
    spyOn(window, 'GetSpaceX');

    it("Spacex should have been called", function(){
        expect(GetSpaceX).toHaveBeenCalled();

    });


});