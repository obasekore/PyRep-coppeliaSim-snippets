# script_call(function_name_at_script_name: str, script_handle_or_type: int, ints=(), floats=(), strings=(), bytes='') → Tuple[List[int], List[float], List[str], str]

# it must be a lua callback... can be either threaded or non-threaded child script
'''
child script of DummyScript object
ikCompute=function (inInts,inFloats,inStrings,inBuffer)
    -- Simply display a dialog box that prints the text stored in inStrings[1]:
    if #inStrings>=1 then
        simDisplayDialog('Message from the remote API client',inStrings[1],sim_dlgstyle_ok,false)
        return {},{},{'message was displayed'},'' -- return a string
    end
end
'''
from pyrep import PyRep
from pyrep.backend import sim, utils
from pyrep.objects.object import Object

pr = PyRep()
pr.launch('NAO_IK_API-experimental.ttt')

pr.start()
pr.step()

target = Object.get_object('targetMovements')
script_handle = sim.simGetScriptAssociatedWithObject(target.get_handle())

text = "testing text"

int_return, float_return, str_return, str_ = pr.script_call("ikCompute@DummyScript", script_handle, strings = text)
